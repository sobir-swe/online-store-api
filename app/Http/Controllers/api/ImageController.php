<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $image = Image::all();
        return response()->json($image);
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
        $image = Image::query()->create([
            'name' => $request->name,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'message' => 'Image Created',
            'status' => 'success',
            'token' => $request,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Image::query()->findOrFail($id));
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
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $image = Image::query()->findOrFail($id);
        $image->update([
            'name' => $request->name,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'message' => 'Image Updated',
            'status' => 'success',
            'token' => $image,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $image = Image::query()->findOrFail($id);
        $image->delete();
        return response()->json([
            'message' => 'Image Deleted',
            'status' => 'success',
            'token' => $image,
        ]);
    }
}
