<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImages;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['mainCategory', 'subcategory', 'brand'])->get();
        return view('admin.Products.index', compact('products'));
    }

    public function create()
    {
        $mainCategories = MainCategory::where('status', 'active')->get();
        $subcategories = SubCategory::where('status', 'active')->get();
        $brands = Brand::where('status', 'active')->get();
        $colors = Color::where('status', 'active')->get();
        $sizes = Size::where('status', 'active')->get();
        return view('admin.Products.add', compact('mainCategories','subcategories', 'brands', 'colors', 'sizes'));

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'product_title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer',
            'sku' => 'required|string|max:50',
            'main_category' => 'required|exists:main_categories,id',
            'sub_category' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_images' => 'required|array|max:6',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'attributes' => 'nullable|array',
            'attributes.*.key' => 'required|string|max:255',
            'attributes.*.value' => 'required|string|max:255',
        ]);

        // Calculate final price after discount
        $price = $request->input('price');
        $discountPrice = $request->input('discount_price');
        $discountPricePercentage = $request->input('discount_percentage');
        // Calculate the discounted price
        $finalPrice = $discountPricePercentage ? $price - ($discountPricePercentage / 100 * $price) : $price;



            // Handle thumbnail image upload
            $thumbnailImageName = time() . '_' . $request->file('thumbnail_image')->getClientOriginalName();
            $request->file('thumbnail_image')->move(public_path('images/products'), $thumbnailImageName);

        // Create a new product
        $product = Product::create([
            'product_title' => $request->input('product_title'),
            'price' => $price,
            'discount_price' => $finalPrice,
            'discount_percentage'=> $discountPricePercentage,
            'quantity' => $request->input('quantity'),
            'sku' => $request->input('sku'),
            'main_category' => $request->input('main_category'),
            'sub_category' => $request->input('sub_category'),
            'brand_id' => $request->input('brand_id'),
            'short_description' => $request->input('short_description'),
            'full_description' => $request->input('full_description'),
            'thumbnail_image' => $thumbnailImageName,
            'status' => $request->input('status'),
        ]);

        // After creating the product
        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                $product->attributes()->create([
                    'key' => $attribute['key'],
                    'value' => $attribute['value'],
                ]);
            }
        }

        // Handle product images upload
        $images = $data['product_images'];
        $imageNames = [];
        foreach ($images as $image) {
            $imagePath = '/storage/' . $image->store('product_images','public');
            $imageNames[] = [
                'image_id' => $imagePath,
                'product_id' => $product->id
            ];
        }
        ProductImages::insert($imageNames);

            // Attach selected colors to the product
            $product->colors()->attach($request->colors);

            // Attach selected colors to the product
            $product->sizes()->attach($request->sizes);
        return redirect()->back()->with('success', 'Product Added  Successfully .');
    }

    public function edit($id){
        $product = Product::with('images', 'attributes')->findOrFail($id);
        $mainCategories = MainCategory::where('status', 'active')->get();
        $subcategories = SubCategory::where('status', 'active')->get();
        $brands = Brand::where('status', 'active')->get();
        $colors = Color::where('status', 'active')->get();
        $sizes = Size::where('status', 'active')->get();
        return view('admin.Products.edit', compact('product','mainCategories','subcategories', 'brands', 'colors', 'sizes'));

    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'product_title' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'nullable|integer',
            'sku' => 'nullable|string|max:50',
            'main_category' => 'nullable|exists:main_categories,id',
            'sub_category' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'colors' => 'array|nullable',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'array|nullable',
            'sizes.*' => 'exists:sizes,id',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_images' => 'nullable|array|max:6',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|in:active,inactive',
            'attributes' => 'nullable|array',
            'attributes.*.key' => 'nullable|string|max:255',
            'attributes.*.value' => 'nullable|string|max:255',
        ]);


        // Fetch the existing product
        $product = Product::findOrFail($id);

        // Calculate the final price after discount
        $price = $request->input('price') ?? $product->price;
        $discountPricePercentage = $request->input('discount_percentage') ?? $product->discount_percentage;
        $finalPrice = $discountPricePercentage ? $price - ($discountPricePercentage / 100 * $price) : $price;

        // Handle thumbnail image upload if a new file is provided
        if ($request->hasFile('thumbnail_image')) {
            // Delete old thumbnail if it exists
            if ($product->thumbnail_image) {
                $oldThumbnailPath = public_path('images/products/' . $product->thumbnail_image);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            // Upload new thumbnail
            $thumbnailImageName = time() . '_' . $request->file('thumbnail_image')->getClientOriginalName();
            $request->file('thumbnail_image')->move(public_path('images/products'), $thumbnailImageName);
        } else {
            $thumbnailImageName = $product->thumbnail_image; // Keep the old thumbnail if no new one is uploaded
        }

        // Update the product details
        $product->update([
            'product_title' => $request->input('product_title', $product->product_title),
            'price' => $price,
            'discount_price' => $finalPrice,
            'discount_percentage' => $discountPricePercentage,
            'quantity' => $request->input('quantity', $product->quantity),
            'sku' => $request->input('sku', $product->sku),
            'main_category' => $request->input('main_category', $product->main_category),
            'sub_category' => $request->input('sub_category', $product->sub_category ?: null),
            'brand_id' => $request->input('brand_id', $product->brand_id),
            'short_description' => $request->input('short_description', $product->short_description),
            'full_description' => $request->input('full_description', $product->full_description),
            'thumbnail_image' => $thumbnailImageName,
            'status' => $request->input('status', $product->status),

        ]);

        // After creating the product
        // Handle attributes update or create
        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                if (isset($attribute['id'])) {
                    // Update existing attribute
                    $existingAttribute = $product->attributes()->find($attribute['id']);
                    if ($existingAttribute) {
                        $existingAttribute->update([
                            'key' => $attribute['key'],
                            'value' => $attribute['value'],
                        ]);
                    }
                } else {
                    // Create new attribute
                    $product->attributes()->create([
                        'key' => $attribute['key'],
                        'value' => $attribute['value'],
                    ]);
                }
            }
        }

        // Handle product images upload
        if ($request->has('product_images')) {
            // Delete old product images if necessary
            // You can implement logic to delete old images if you want

            $images = $data['product_images'];
            $imageNames = [];
            foreach ($images as $image) {
                $imagePath = '/storage/' . $image->store('product_images', 'public');
                $imageNames[] = [
                    'image_id' => $imagePath,
                    'product_id' => $product->id
                ];
            }
            ProductImages::insert($imageNames);
        }

        // Attach selected colors to the product
        $colors = $request->input('colors', []);
        $product->colors()->sync($colors);

        // Attach selected sizes to the product
        $sizes = $request->input('sizes', []);
        $product->sizes()->sync($sizes);


        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = ProductImages::findOrFail($id); // Fetch the image record
        $imagePath = public_path('storage/' . $image->image_id); // Construct the full image path

        // Optionally delete the physical file
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the file from the storage
        }

        $image->delete(); // Delete the record from the database

        return response()->json(['success' => true]);
    }
    public function attributesDestroy($id)
    {
        $attribute = ProductAttribute::findOrFail($id);
        $attribute->delete();

        return response()->json(['message' => 'Attribute deleted successfully!']);
    }




}
