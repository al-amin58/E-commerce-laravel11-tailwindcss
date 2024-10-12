<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string|max:255|unique:sizes,size',
            'status' => 'required|string|in:active,inactive',
        ],[
            'size.unique' => 'The size has already been taken.',
        ]);


        // Create the in the database
        Size::create([
            'size' => $request->input('size'),
            'status' => $request->input('status'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Size added successfully!');
    }

    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.size.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $size = Size::findOrFail($id);

        $request->validate([
            'size' => 'nullable|string|max:255|unique:sizes,size,' . $id,
            'status' => 'nullable|string|in:active,inactive',
        ],[
            'size.unique' => 'The size has already been taken.',
        ]);

        $size->update([
            'size' => $request->input('size') ?: $size->color,
            'status' => $request->input('status') ?: $size->status
        ]);

        return redirect()->route('admin.size')->with('success', 'Size updated successfully.');

    }

    public function destroy($id)
    {
        $size = Size::find($id); // Check this line
        $size->delete();
        return redirect()->back()->with('success', 'Size deleted successfully.');
    }

}
