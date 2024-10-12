<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255|unique:brands,brand_name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:active,inactive',
        ],[
            'brand_name.unique' => 'The brand name has already been taken.',
        ]);

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images', $imageName, 'public');
            } else {
                return redirect()->back()->withErrors(['image' => 'Invalid file upload for image.']);
            }
        } else {
            return redirect()->back()->withErrors(['image' => 'Image file is required.']);
        }

        // Create the main category in the database
        Brand::create([
            'brand_name' => $request->input('brand_name'),
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $bran = Brand::findOrFail($id);
        $request->validate([
            'brand_name' => 'nullable|string|max:255|unique:brands,brand_name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|string|in:active,inactive',
        ],[
            'brand_name.unique' => 'The brand name has already been taken.',
        ]);
        $imagePath = $bran->image;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if (file_exists(public_path($bran->image))) {
                unlink(public_path($bran->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        $bran->update([
            'brand_name' => $request->input('brand_name') ?: $bran->brand_name,
            'image' => $imagePath,
            'status' => $request->input('status') ?: $bran->status
        ]);

        return redirect()->route('admin.brand')->with('success', 'Brand updated successfully.');

    }

    public function destroy($id)
    {
        $bran = Brand::find($id); // Check this line
        $bran->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully.');
    }
}
