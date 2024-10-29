<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category; // Include this if you want to fetch categories
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Assuming you have a Category model
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cate_id' => 'required|exists:categories,id',
            'product_name' => 'required|max:255',
            'small_description' => 'required|max:500',
            'description' => 'required',
            'original_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qty' => 'required|integer',
            'tax' => 'nullable|numeric',
            'status' => 'boolean',
            'trending' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        $product = new Product();
        $product->cate_id = $request->cate_id;
        $product->product_name = $request->product_name;
        $product->small_description = $request->small_description;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->selling_price = $request->selling_price;
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->status = $request->status ? 1 : 0;
        $product->trending = $request->trending ? 1 : 0;
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $product->image = $imageName;
        }
        
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'cate_id' => 'required|exists:categories,id',
            'product_name' => 'required|max:255',
            'small_description' => 'required|max:500',
            'description' => 'required',
            'original_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qty' => 'required|integer',
            'tax' => 'nullable|numeric',
            'status' => 'boolean',
            'trending' => 'boolean',
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        $product->cate_id = $request->cate_id;
        $product->product_name = $request->product_name;
        $product->small_description = $request->small_description;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->selling_price = $request->selling_price;
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->status = $request->status ? 1 : 0;
        $product->trending = $request->trending ? 1 : 0;
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                unlink(public_path('images/products/' . $product->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete the image file if it exists
        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
