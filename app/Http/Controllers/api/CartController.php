<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Cart::all());
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
        $carts = Cart::query()->create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json($carts);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $cart = Cart::query()->findOrFail($id);
        return response()->json($cart);
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
        $cart = Cart::query()->findOrFail($id);
        $cart->update([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'message' => 'Cart updated successfully',
            'status' => 'success',
            'token' => $cart,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $cart = Cart::query()->findOrFail($id);
        $cart->delete();
        return response()->json([
            'message' => 'cart deleted successfully',
            'status_code' => 'success',
            'token' => $cart,
        ]);
    }
}
