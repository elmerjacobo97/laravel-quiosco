<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Validar el registro del usuario
        $data = $request->validated();

        // Crear el user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Retornar una resp
        return [
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken
        ];
    }



    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        // Revisar el password
        if (!Auth::attempt($data)) {
            return response([
                'errors' => [
                    'email' => ['Credenciales incorrectas']
                ]
            ], 422);
        }

        // Autenticar al user
        $user = Auth::user(); // Aquí está el cambio
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user,
        ];
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null,
            'message' => 'Logout exitoso'
        ];
    }
}
