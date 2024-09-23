<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $products = Product::paginate(16);
    return view('product.index', compact('products'));
    }
    public function show($id)
{
    // Fetch the product by its ID
    $product = Product::find($id);

    // Check if the product exists
    if (!$product) {
        // Handle the case where the product is not found (e.g., show a 404 page)
        abort(404, 'Product not found');
    }

    // Pass the product to the view
    return view('product.show', compact('product'));
}

    

}
