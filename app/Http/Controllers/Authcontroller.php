<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    // Validate incoming request
    $request->validate([
        'whatsapp_number' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt(['whatsapp_number' => $request->whatsapp_number, 'password' => $request->password])) {
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role' => $user->role,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'surname' => $user->surname,
            'whatsapp_number' => $user->whatsapp_number,
            'photo' => $user->photo ? asset('storage/' . $user->photo) : null, // Add photo URL
        ], 200);
    }

    return response()->json(['message' => 'Incorrect login or password'], 401);
}
    public function register(Request $request)
    {
        try {
            $fields = $request->validate([
                "first_name" => 'required|string',
                "last_name" => 'required|string',
                "surname" => 'required|string',
                "whatsapp_number" => 'required|string|unique:users',
                "password" => 'required|string|confirmed',
            ]);

            $user = User::create([
                'first_name' => $fields['first_name'],
                'last_name' => $fields['last_name'],
                'surname' => $fields['surname'],
                'whatsapp_number' => $fields['whatsapp_number'],
                'password' => bcrypt($fields['password']),
            ]);

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response($response, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response(['message' => $e->errors()], 400);
        }
    }


    public function uploadPhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();

    // Delete existing photo if any
    if ($user->photo) {
        \Storage::delete('public/' . $user->photo);
    }

    // Store new photo
    $path = $request->file('photo')->store('photos', 'public');
    $user->photo = $path;
    $user->save();

    return response()->json(['photo' => asset('storage/' . $path)], 200);
}


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out'], 201);
    }
}
