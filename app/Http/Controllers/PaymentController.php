<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function createMoMoPayment(Order $order)
    {
        if (!$order instanceof Order) {
            Log::error('createMoMoPayment Error: Invalid Order object');
            return redirect()->back()->withErrors(['message' => 'Đơn hàng không hợp lệ.']);
        }

        $momoEndpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = env('MOMO_PARTNER_CODE', 'MOMOBKUN20180529');
        $accessKey = env('MOMO_ACCESS_KEY', 'klm05TvNBzhg7h7j');
        $secretKey = env('MOMO_SECRET_KEY', 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa');
        $orderInfo = 'Thanh toán đơn hàng MoMo';
        $amount = (float) $order->amount;

        // Ensure orderId has the correct format
        $orderId = $order->id . '_' . time();
        $ipnUrl = route('momo.ipn'); // Update to ngrok URL
        $redirectUrl = route('momo.return'); // Update to ngrok URL

        $requestId = time();
        $requestType = "captureWallet";
        $extraData = "";

        $rawHash = "accessKey={$accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$ipnUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$partnerCode}&redirectUrl={$redirectUrl}&requestId={$requestId}&requestType={$requestType}";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $params = [
            'partnerCode' => $partnerCode,
            'partnerName' => "YourStore",
            'storeId' => "StoreID",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
        ];

        $response = $this->execPostRequest($momoEndpoint, json_encode($params));
        Log::info('MoMo Response: ', ['response' => $response]);

        $jsonResponse = json_decode($response, true);

        if (isset($jsonResponse['payUrl'])) {
            return redirect()->away($jsonResponse['payUrl']);
        } else {
            Log::error('MoMo Payment Error:', ['response' => $jsonResponse]);
            return redirect()->back()->withErrors(['message' => 'MoMo payment error', 'details' => $jsonResponse]);
        }
    }

    public function handleMoMoReturn(Request $request)
    {
        $data = $request->all();
        Log::info('MoMo Return Data: ', ['data' => $data]);
    
        // Bỏ qua kiểm tra chữ ký để debug
        // $partnerCode = env('MOMO_PARTNER_CODE');
        // $accessKey = env('MOMO_ACCESS_KEY');
        // $secretKey = env('MOMO_SECRET_KEY');
        // $signature = $data['signature'] ?? '';
    
        // Đảm bảo các trường cần thiết có mặt
        if (!isset($data['amount'], $data['orderId'], $data['requestId'], $data['resultCode'])) {
            Log::error('MoMo Return Error: Thiếu các trường cần thiết', ['data' => $data]);
            return redirect()->route('order.failed')->with('message', 'Thông tin trả về không đầy đủ.');
        }
    
        // Tách ID đơn hàng và thời gian
        $orderParts = explode('_', $data['orderId']);
        if (count($orderParts) !== 2) {
            Log::error('MoMo Return Error: Định dạng ID đơn hàng không hợp lệ', ['orderId' => $data['orderId']]);
            return redirect()->route('order.failed')->with('message', 'Định dạng ID đơn hàng không hợp lệ.');
        }
    
        [$orderId, $timestamp] = $orderParts;
    
        // Ghi log để debug mà không cần kiểm tra chữ ký
        Log::info('MoMo Return Debug', [
            'orderId' => $orderId,
            'amount' => $data['amount'],
            'resultCode' => $data['resultCode'],
            'orderInfo' => $data['orderInfo'],
        ]);
    
        $order = Order::find($orderId);
    
        if (!$order) {
            Log::error('MoMo Return Error: Đơn hàng không tìm thấy', ['orderId' => $orderId]);
            return redirect()->route('order.failed')->with('message', 'Đơn hàng không tồn tại.');
        }
    
        if ($data['resultCode'] == '0') {
            $order->payment_status = 'Thanh toán thành công';
            $order->transaction_id = $data['transId']; // Lưu mã giao dịch
            $order->save();
            Cart::destroy();
            return view('order.success', compact('order'));
        } else {
            $order->payment_status = 'Thanh toán thât bại';
            $order->save();
            return redirect()->route('order.failed')->with('message', 'Thanh toán không thành công.');
        }
    }
    
        protected function execPostRequest(string $url, string $data): string
    {
        $client = new Client();

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $data,
            ]);

            return $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error('HTTP POST Request Error', [
                'url' => $url,
                'requestBody' => $data,
                'error' => $e->getMessage(),
                'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body'
            ]);
            return json_encode(['error' => 'Unable to process request']);
        } catch (\Exception $e) {
            Log::error('General Error', ['error' => $e->getMessage()]);
            return json_encode(['error' => 'Unable to process request']);
        }
    }

    public function handleMoMoIpn(Request $request)
    {
        $data = $request->all();
        Log::info('MoMo IPN Data: ', ['data' => $data]);

        $orderId = $data['orderId'] ?? '';
        $order = Order::find($orderId);

        if (!$order) {
            Log::error('MoMo IPN Error: Order not found', ['orderId' => $orderId]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($data['resultCode'] == '0') {
            // Payment successful
            $order->pay = 'completed';
            $order->save();
            Cart::destroy();
        } else {
            // Payment failed
            $order->pay = 'failed';
            $order->save();
        }

        return response()->json(['message' => 'IPN processed successfully']);
    }
}
