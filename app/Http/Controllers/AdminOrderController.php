<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
   function index(){
      $orders = Order::all();
    return view('admin.orders.index',compact('orders'));
   }
   function show($id)
    {
        $order = Order::with('orderItems.product')->find($id);

    if (!$order) {
        return redirect()->back()->withErrors(['message' => 'Đơn hàng không tồn tại.']);
    }

    return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status,
        ]);
        if ($request->status == 'Đã giao thành công') {
            $order->update([
                'payment_status' => 'Thanh toán thành công', 
            ]);
        }
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
