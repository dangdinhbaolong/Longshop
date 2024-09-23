<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create()
    {
        return view('order.create');
    }
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
                   ->where('payment_status', '!=', 'Bị hủy')
                   ->orderBy('created_at', 'desc')
                   ->get();
        return view('order.index', compact('orders'));
    }

    function show($id)
    {
        $order = Order::with('orderItems.product')->find($id);

    if (!$order) {
        return redirect()->back()->withErrors(['message' => 'Đơn hàng không tồn tại.']);
    }

    return view('order.show', compact('order'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'name' =>'required',
            'adress' =>'required',
            'phone' =>'required',
            'payment_method' => 'required|string|in:Cod,Momo,Vnpay',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'name' => $request->name,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'payment_status ' => 'pending',
        ]);

        // Save order items
        foreach (Cart::content() as $item) {
            $order->orderItems()->create([
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        // Store the order ID in session
        $request->session()->put('order_id', $order->id);

        // Handle payment based on selected method
        return $this->handlePayment($order, $request->payment_method);
    }

    private function handlePayment($order, $paymentMethod)
    {
        switch ($paymentMethod) {
            case 'Cod':
                $order->payment_status  = 'Chưa thanh toán';
                $order->cod_id = 'COD_'.time();
                $order->save();
                return redirect()->route('order.success')->with('message', 'Đặt hàng thành công! Bạn sẽ thanh toán khi nhận hàng.');

            case 'Momo':
                return redirect()->route('payment.momo', ['order' => $order->id]);

            default:
                return redirect()->back()->withErrors(['payment_method' => 'Phương thức thanh toán không hợp lệ']);
        }
    }

    public function success(Request $request)
    {
        $orderId = $request->session()->get('order_id');

        if (!$orderId) {
            return redirect()->route('order.failed')->withErrors(['message' => 'Không tìm thấy thông tin đơn hàng.']);
        }

        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('order.failed')->withErrors(['message' => 'Đơn hàng không hợp lệ.']);
        }
        Cart::destroy();
        return view('order.success', compact('order'));
    }

    public function failed(Request $request)
    {
        $orderId = $request->session()->get('order_id');
        $order = Order::find($orderId);
        return view('order.failed', compact('order'));
    }
}
