<?php

namespace App\Http\Controllers\frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    //
    public function index()
    {

        $catageries = Category::all();
        $trendingProducts=Product::where(['status' =>1 ,'trending'=>1])->get();
        return view("welcome", compact("catageries",'trendingProducts'));
    }
    public function categoryPage($slug)
    {
        $allCats=Category::get();
        $catageries =Category::where("slug", $slug)->first();

        $products=Product::where('cate_id', $catageries->id)->get();

return view('frontend.categoryList', compact('products','slug','catageries','allCats'));

    }
    public function productList()
    {
        $products=Product::where('status',1)->get();
        return view('frontend.productList', compact('products'));
    }
    public function productDetail($product_name)
{

    $product = Product::where('product_name', $product_name)->first();

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }

    $relatedProductsCateId=Product::where('status',1)
    ->where('product_name',$product_name)
    ->get('cate_id');

    $relatedProducts=Product::where('status',1)
    ->where('cate_id',$relatedProductsCateId)
    ->get();



    return view('frontend.productDetails', compact('product','relatedProducts'));
}
public function cart()
{
    // Get the cart count for the authenticated user
    $cartCount = Cart::where('user_id', Auth::id())->count(); // Get the cart count

    // Return the cart view with the cart count
    return view('frontend.layout', compact('cartCount')); // Change 'frontend.cart' to the correct view name
}




}
