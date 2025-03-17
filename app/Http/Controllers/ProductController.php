<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subcategory', 'user')->withCount('stocks')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $subcategories = Subcategory::where('status', 'active')->get();
        return view('admin.product.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $subcategories = Subcategory::where('status', 'active')->get();
        return view('admin.product.edit', compact('product', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    public function syncQuantity(Product $product)
{
    $stockCount = $product->stocks()->count();
    $product->quantity = $stockCount;
    $product->save();

    return redirect()->route('product.index')
        ->with('success', "Đã cập nhật số lượng sản phẩm '{$product->name}' thành {$stockCount}");
}
}

