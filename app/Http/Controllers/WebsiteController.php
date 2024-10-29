<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    private function getMainCategories()
    {
        return MainCategory::with(['subCategories' => function ($query) {
            $query->where('status', 'active');
        }])->where('status', 'active')->get();
    }

    public function index(Request $request)
    {
        $searchTerm = $request->get('search');
        $catId = $request->get('catId');
        $catSubId = $request->get('catSubId');

        $query = Product::where('status', 'active');

        // Add search functionality
        if ($searchTerm) {
            $query->where('product_title', 'like', '%' . $searchTerm . '%');
        }

        // Filter products by main category if catId is provided
        if ($catId) {
            $query->where('main_category_id', $catId);
        }

        // Filter products by subcategory if catSubId is provided
        if ($catSubId) {
            $query->where('sub_category_id', $catSubId);
        }


        $mainCategories = $this->getMainCategories();

        // Fetch brands
        $brands = Brand::where('status', 'active')->get();


        return view('website.home', compact('mainCategories', 'brands', 'searchTerm'));
    }


    public function about(){
        $mainCategories = $this->getMainCategories();
        return view('website.about', compact('mainCategories'));
    }
    public function contact(){
        $mainCategories = $this->getMainCategories();
        return view('website.contact', compact('mainCategories'));
    }
    public function shop(Request $request) {
        $catId = $request->get('catId');
        $brandId = $request->get('brand');
        $priceRange = $request->get('price');
        $sortOrder = $request->get('sort', 'products');
        $searchTerm = $request->get('search');
        $catSubId = $request->get('catSubId');

        // Start with the query for active products
        $query = Product::where('status', 'active');

        // If a category ID is provided, filter products by that category
        if ($catId) {
            $query->where('main_category_id', $catId);
        }
        // Filter products by subcategory if catSubId is provided
        if ($catSubId) {
            $query->where('sub_category_id', $catSubId);
        }
        // If a brand ID is provided, filter products by that brand
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }
        // Handle price range filtering
        if ($priceRange) {
            $prices = explode('-', $priceRange);
            $minPrice = isset($prices[0]) ? (float)$prices[0] : 0;
            $maxPrice = isset($prices[1]) ? (float)$prices[1] : PHP_INT_MAX;

            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Handle price sorting before paginating

        if ($sortOrder === 'high-low') {
            $query->orderBy('price', 'desc');
        } elseif ($sortOrder === 'products') {
            $query->orderBy('id', 'asc');
        } else {
            $query->orderBy('price', 'asc');
        }

        // Add search functionality
        if ($searchTerm) {
            $query->where('product_title', 'like', '%' . $searchTerm . '%'); // Search in the product name
        }

        $products = $query->with(['mainCategory', 'subcategory', 'brand'])->paginate(10);
        $mainCategories = MainCategory::with(['subCategories' => function ($query) {
            $query->where('status', 'active');
        }])->where('status', 'active')->get();

        $brands = Brand::where('status', 'active')->get();
        return view('website.product', compact('products', 'mainCategories', 'brands', 'catId', 'brandId', 'priceRange', 'sortOrder', 'searchTerm'));
    }

    public function productDetails($id){
        $product = Product::with(['product_attributes', 'images'])->findOrFail($id);

        $mainCategories = $this->getMainCategories();
        return view('website.product-details', compact('mainCategories', 'product'));
    }

    public function checkout(){
        $mainCategories = $this->getMainCategories();
        return view('website.checkout', compact('mainCategories'));
    }
    public function cart(){

        $mainCategories = $this->getMainCategories();
        return view('website.cart', compact('mainCategories'));
    }

    public function searchSuggestions(Request $request)
    {
        $searchTerm = $request->get('term');

        $products = Product::where('product_title', 'like', '%' . $searchTerm . '%')
            ->where('status', 'active')
            ->take(5) // Limit to 5 results
            ->get(['id', 'product_title']); // Only fetch the necessary fields

        return response()->json($products);
    }



}
