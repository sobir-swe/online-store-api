<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $comments = Comment::all();
        return response()->json($comments);
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
        $comment = Comment::query()->create([
            'text' => $request->text,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'message' => 'Comment created successfully',
            'status' => 'success',
            'token' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Comment::query()->findOrFail($id));
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
        $comment = Comment::query()->findOrFail($id);
        $comment->update([
            'text' => $request->text,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'message' => 'Comment updated successfully',
            'status' => 'success',
            'token' => $comment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $comment = Comment::query()->findOrFail($id);
        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted successfully',
            'status' => 'success',
            'token' => response()->json([
                'message' => 'Comment deleted successfully',
                'status' => 'success',
                'token' => $comment,
            ]),
        ]);
    }
}
