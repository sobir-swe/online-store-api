<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $category = Category::all();

        return response()->json($category);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|string|max:255',
            'parent_id' => 'required|integer|exists:categories,id'
        ]);


        $category = Category::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'parent_id' => $request->parent_id
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'status_code' => 'success',
            'token' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Category::query()->findOrFail($id));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|string|max:255',
            'parent_id' => 'required|integer|exists:categories,id'
        ]);

        $category = Category::query()->findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'parent_id' => $request->parent_id
        ]);
        return response()->json([
            'message' => 'Category updated successfully',
            'status_code' => 'success',
            'token' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully',
            'status_code' => 'success',
            'token' => $category
        ], 204);
    }
}
