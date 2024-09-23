<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
class AdminController extends Controller
{
     function index(){
         $products =Product::all();
         $orders = Order::all();
        return view('admin.dashboard',compact(['products','orders']));
     }
}
