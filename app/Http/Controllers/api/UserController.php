<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
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
    public function store(Request $request)
    {
        $user = User::query()->create([
           'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return response()->json([
            'message' => 'User created successfully',
            'status' => 'success',
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(User::query()->findOrFail($id));
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
        $user = User::query()->findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return response()->json([
            'message' => 'User updated successfully',
            'status' => 'success',
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
            'status' => 'success',
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }
}
