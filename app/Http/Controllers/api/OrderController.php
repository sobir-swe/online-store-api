<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Order::all());
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
        $order = Order::query()->create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'total_amount' => $request->total_amount
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'status_code' => 'success',
            'token' => $order,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Order::query()->findOrFAil($id));
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
        $order = Order::query()->findOrFail($id);
        $order->update([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'total_amount' => $request->total_amount,
        ]);
        return response()->json([
            'message' => 'Order updated successfully',
            'status' => 'success',
            'token' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $order = Order::query()->findOrFail($id);
        $order->delete();
        return response()->json([
            'message' => 'Order deleted successfully',
            'status' => 'success',
            'token' => $order,
        ]);
    }
}
