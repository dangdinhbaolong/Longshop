<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
class AdminController extends Controller
{
     public function index()
     {
         // Get total counts for each order status
         $totalOrderCancel = Order::where('status', 'Bị hủy')->count();
         $totalOrderComplete = Order::where('status', 'Đã giao thành công')->count();
         $totalOrderPending = Order::where('status', 'Chờ xử lý')->count();
         $totalOrder = Order::sum('amount');
     
         // Prepare data for the chart
         $statuses = ['Chờ xử lý', 'Đã giao thành công', 'Bị hủy'];
         $ordersData = [
             'labels' => [], // To hold the labels for the last 7 days
             'data' => [[], [], []], // To hold the counts for each status
         ];
     
         // Loop through the last 7 days
         for ($i = 0; $i < 30; $i++) {
             $date = now()->subDays($i)->format('Y-m-d'); // Get the date
     
             // Count orders by status for the current date
             $ordersData['data'][0][] = Order::where('status', 'Chờ xử lý')->whereDate('created_at', $date)->count(); // Pending
             $ordersData['data'][1][] = Order::where('status', 'Đã giao thành công')->whereDate('created_at', $date)->count(); // Completed
             $ordersData['data'][2][] = Order::where('status', 'Bị hủy')->whereDate('created_at', $date)->count(); // Canceled
     
             // Prepare labels for the x-axis (last 7 days)
             $ordersData['labels'][] = now()->subDays($i)->format('d/m'); // Format date for display
         }
     
         // Reverse the data arrays to have the correct order (oldest to newest)
         $ordersData['data'][0] = array_reverse($ordersData['data'][0]);
         $ordersData['data'][1] = array_reverse($ordersData['data'][1]);
         $ordersData['data'][2] = array_reverse($ordersData['data'][2]);
         $ordersData['labels'] = array_reverse($ordersData['labels']);
     
         // Retrieve all products
         $products = Product::all();
     
         // Retrieve all orders if needed
         $orders = Order::all();
     
         return view('admin.dashboard', compact([
             'products',
             'ordersData',
             'orders',
             'totalOrderCancel',
             'totalOrderComplete',
             'totalOrderPending',
             'totalOrder'
         ]));
     }
     
}
