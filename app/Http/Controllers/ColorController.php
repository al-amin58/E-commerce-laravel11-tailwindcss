<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        $colors = Color::all();
        return view('admin.color.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required|string|max:255|unique:colors,color',
            'color_code' => 'required|string',
            'status' => 'required|string|in:active,inactive',
        ],[
            'color.unique' => 'The color name has already been taken.',
        ]);


        // Create the main category in the database
        Color::create([
            'color' => $request->input('color'),
            'color_code' => $request->input('color_code'),
            'status' => $request->input('status'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Color added successfully!');
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.color.edit', compact('color'));
    }

    public function update(Request $request, $id)
    {
        $color = Color::findOrFail($id);

        $request->validate([
            'color' => 'nullable|string|max:255|unique:colors,color,' . $id,
            'color_code' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive',
        ],[
            'color.unique' => 'The color has already been taken.',
        ]);

        $color->update([
            'color' => $request->input('color') ?: $color->color,
            'color_code' => $request->input('color_code'),
            'status' => $request->input('status') ?: $color->status
        ]);

        return redirect()->route('admin.color')->with('success', 'Color updated successfully.');

    }

    public function destroy($id)
    {
        $color = Color::find($id); // Check this line
        $color->delete();
        return redirect()->back()->with('success', 'Color deleted successfully.');
    }

}
