<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(OrderProduct::all());
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
        $orderProduct = OrderProduct::query()->create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'message' => 'OrderProduct created successfully',
            'status_code' => 'success',
            'token' => $orderProduct,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(OrderProduct::query()->findOrFAil($id));
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
        $orderProduct = OrderProduct::query()->findOrFail($id);
        $orderProduct->update([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'message' => 'OrderProduct updated successfully',
            'status' => 'success',
            'token' => $orderProduct,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $order = OrderProduct::query()->findOrFail($id);
        $order->delete();
        return response()->json([
            'message' => 'OrderProduct deleted successfully',
            'status' => 'success',
            'token' => $order,
        ]);
    }
}
