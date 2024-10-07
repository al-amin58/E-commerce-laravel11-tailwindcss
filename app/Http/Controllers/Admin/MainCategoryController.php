<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    public function index()
    {
        $mainCategroes = MainCategory::all();
        return view('admin.category.main-category.index', compact('mainCategroes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_category_name' => 'required|string|max:255',
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
        MainCategory::create([
            'main_category_name' => $request->input('main_category_name'),
            'icon' => $iconPath,
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Main Category added successfully!');
    }


    public function edit($id) {
        $mainCategory = MainCategory::findOrFail($id);

        return view('admin.category.main-category.edit', compact('mainCategory'));

    }


    public function update(Request $request, $id)
    {

        // Find the category
        $mainCategory = MainCategory::findOrFail($id);

        $iconPath = $mainCategory->icon;
        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if (file_exists(public_path($mainCategory->icon))) {
                unlink(public_path($mainCategory->icon));
            }
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $iconPath = $icon->storeAs('images', $iconName, 'public');
        }

        $imagePath = $mainCategory->image;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if (file_exists(public_path($mainCategory->image))) {
                unlink(public_path($mainCategory->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }


        $mainCategory->update([
            'main_category_name' => $request->input('main_category_name'),
            'icon' => $iconPath,
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);

        // Redirect or return a response
        return redirect()->route('admin.maincategory')->with('success', 'Main Category updated successfully.');
    }


    public function destroy($id)
    {
        $mainCategory = MainCategory::find($id); // Check this line
        $mainCategory->delete();
        return redirect()->back()->with('success', 'Main Category deleted successfully.');
    }
}
