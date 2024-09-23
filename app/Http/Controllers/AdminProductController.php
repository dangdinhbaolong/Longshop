<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'quantity' => 'required|integer',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = null;
    if ($request->hasFile('image_path')) {
        $imageName = time() . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('images/products'), $imageName);
    }
      
    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'description' => $request->description,
        'image_path' => $imageName,
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully');
}

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('admin.products.show', compact('product'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    // AdminProductController.php
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'quantity' => 'required|integer',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        // Xử lý hình ảnh nếu có
        $imageName = $product->image_path; // Giữ tên hình ảnh cũ nếu không có hình ảnh mới
        if ($request->hasFile('image_path')) {
            // Xóa hình ảnh cũ nếu có
            if ($product->image_path) {
                Storage::delete('public/images/products/' . $product->image_path);
            }
            // Tạo tên mới cho hình ảnh
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images/products'), $imageName);
        }
    
        // Cập nhật sản phẩm
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image_path' => $imageName,
        ]);
    
        return redirect()->route('products.index')->with('update', 'Product updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
   function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('delete', 'Product deleted successfully');
    }
}
