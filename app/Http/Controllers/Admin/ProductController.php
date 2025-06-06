<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        // dd($products);
        return Inertia::render('Admin/Products/index', ['products'=>$products]);
    }

    public function store(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();

        if($request->hasFile('product_images'))
        {
            $productImages = $request->file('product_images');
            // foreach()
            // {

            // }
        }
        
    }
}
