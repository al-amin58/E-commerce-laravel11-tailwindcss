<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        $mainCategories = MainCategory::where('status', 'active')->get();
        $subCategories = SubCategory::all();
        return view('admin.category.sub-category.index', compact('mainCategories', 'subCategories'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'Sub_category_name' => 'required|string|max:255',
            'main_category_id' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Handle the icon upload
        $iconPath = null;
        if ($request->hasFile('icon')) {
            // Handle the icon upload
            $icon = $request->file('icon');
            if ($icon->isValid()) {
                $iconName = time() . '.' . $icon->getClientOriginalExtension();
                $iconPath = $icon->storeAs('images', $iconName, 'public');
            } else {
                return redirect()->back()->withErrors(['icon' => 'Invalid file upload for icon.']);
            }
        } else {
            return redirect()->back()->withErrors(['icon' => 'Icon file is required.']);
        }

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
        SubCategory::create([
            'Sub_category_name' => $request->input('Sub_category_name'),
            'main_category_id' => $request->input('main_category_id'),
            'icon' => $iconPath,
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Sub Category added successfully!');
    }

    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $mainCategories = MainCategory::where('status', 'active')->get();
        return view('admin.category.sub-category.edit', compact('subCategory', 'mainCategories'));
    }


    public function update(Request $request, $id)
    {

        // Find the category
        $subCategory = SubCategory::findOrFail($id);

        $iconPath = $subCategory->icon;
        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if (file_exists(public_path($subCategory->icon))) {
                unlink(public_path($subCategory->icon));
            }
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $iconPath = $icon->storeAs('images', $iconName, 'public');
        }

        $imagePath = $subCategory->image;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if (file_exists(public_path($subCategory->image))) {
                unlink(public_path($subCategory->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }


        $subCategory->update([
            'Sub_category_name' => $request->input('Sub_category_name'),
            'main_category_id' => $request->input('main_category_id'),
            'icon' => $iconPath,
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        // Redirect or return a response
        return redirect()->route('admin.subcategory')->with('success', 'Sub Category updated successfully.');
    }


    public function destroy($id)
    {
        $subCategory = SubCategory::find($id); // Check this line
        $subCategory->delete();
        return redirect()->back()->with('success', 'Sub Category deleted successfully.');
    }

}
