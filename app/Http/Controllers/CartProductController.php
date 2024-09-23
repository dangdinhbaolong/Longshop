<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    public function show()
    {
        return view('cart.show');
    }
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->withErrors('Product not found');
        }
        Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => 1,  
            'price'   => $product->price,
            'options' => ['image_path' => $product->image_path]
        ]);
        return redirect('cart/show')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }
    function remove($rowId){
        Cart::remove($rowId);
        return redirect('cart/show')->with('update', 'Giỏ hàng được cập nhật thành công ');
    }
    function destroy(){
        Cart::destroy();
        return redirect('cart/show')->with('update', 'Giỏ hàng được cập nhật thành công ');
    }
    public function update(Request $request)
{
    // Get the 'qty' input array from the request
    $data = $request->get('qty');

    // Loop through each item and update the cart quantity
    foreach ($data as $rowId => $quantity) {
        Cart::update($rowId, $quantity);
    }

    // Redirect back to the cart page
    return redirect('cart/show')->with('update', 'Giỏ hàng được cập nhật thành công ');
}

}
