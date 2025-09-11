<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MusicCategory;
use Illuminate\Http\Request;

class MusicCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MusicCategory::latest()->get();
        return view('admin.music_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.music_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'music_category' => 'required|string|max:255|unique:music_categories,music_category'
        ]);

        MusicCategory::create([
            'music_category' => $request->music_category
        ]);

        return redirect()->route('admin.music-categories.index')
            ->with('success', 'Music category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = MusicCategory::findOrFail($id);
        return view('admin.music_categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = MusicCategory::findOrFail($id);
        return view('admin.music_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = MusicCategory::findOrFail($id);
        
        $request->validate([
            'music_category' => 'required|string|max:255|unique:music_categories,music_category,' . $id
        ]);

        $category->update([
            'music_category' => $request->music_category
        ]);

        return redirect()->route('admin.music-categories.index')
            ->with('success', 'Music category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = MusicCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.music-categories.index')
            ->with('success', 'Music category deleted successfully!');
    }
}