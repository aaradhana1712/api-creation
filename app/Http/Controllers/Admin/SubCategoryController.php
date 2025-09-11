<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MusicSubCategory;
use App\Models\MusicCategory;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = MusicSubCategory::with('musicCategory')->latest()->get();
        return view('admin.sub-category.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = MusicCategory::all();
        return view('admin.sub-category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'music_category_id' => 'required|exists:music_category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'music_category_id']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('sub_categories', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        MusicSubCategory::create($data);

        return redirect()->route('admin.sub-category.index')
                         ->with('success', 'Sub Category created successfully!');
    }

    public function edit($id)
    {
        $subCategory = MusicSubCategory::findOrFail($id);
        $categories = MusicCategory::all();
        return view('admin.sub-category.edit', compact('subCategory', 'categories'));
    }
    public function show($id)
{
    $subcategory = MusicSubCategory::with('musicCategory')->findOrFail($id);
    return view('admin.sub-category.show', compact('subcategory'));
}

    public function update(Request $request, $id)
    {
        $subCategory = MusicSubCategory::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'music_category_id' => 'required|exists:music_category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'music_category_id']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
                Storage::disk('public')->delete($subCategory->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('sub_categories', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $subCategory->update($data);

        return redirect()->route('admin.sub-category.index')
                         ->with('success', 'Sub Category updated successfully!');
    }

    public function destroy($id)
    {
        $subCategory = MusicSubCategory::findOrFail($id);
        
        // Delete image file
        if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
            Storage::disk('public')->delete($subCategory->image);
        }

        $subCategory->delete();

        return redirect()->route('admin.sub-category.index')
                         ->with('success', 'Sub Category deleted successfully!');
    }
}
