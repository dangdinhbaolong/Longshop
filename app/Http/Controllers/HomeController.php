<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $products = Product::paginate(8);
    return view('/dashboard', compact('products'));
    }
}
