<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.Products.index');
    }

    public function add()
    {
        $mainCategories = MainCategory::where('status', 'active')->get();
        $subcategories = SubCategory::where('status', 'active')->get();
        $brands = Brand::where('status', 'active')->get();
        return view('admin.Products.add', compact('mainCategories', 'subcategories', 'brands'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_field_name' => 'nullable',
        ]);

        foreach ($request->product_images as $key => $value) {
            $imageName = time() . '.' . $value->extension();
            $value->move(public_path('images/products'), $imageName);
            $imgeNames[] = $imageName;
        }

        foreach ($request->new_field_name as $key => $value) {
            Product::create($value);
        }

        // Create a new product
        $product = Product::create([
            'name' => $request->input('product_name'),
            'description' => $request->input('product_description'),
            'main_category_id' => $request->input('main_category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'brand_id' => $request->input('brand_id'),
        ]);

        return redirect()->back()->with('success', 'Product Add Succesfully .');
    }

}
