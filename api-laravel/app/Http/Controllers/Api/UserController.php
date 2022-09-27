<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->only('name', 'email', 'password');
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'email' => 'required|string|unique:users',
                'password' => 'required'
            ], [
                'name.required' => 'Nome é um campo obrigatório.',
                'email.required' => 'E-mail é um campo obrigatório.',
                'email.unique' => 'E-mail já cadastrado. Tente novamente',
                'password.required' => 'Senha é um campo obrigatório.',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if (!$user->save()) {
                throw new \Exception("Usuário não foi carastrado. Tente novamente!");
            }

            return response()->json([
                'error' => false,
                'response' => [
                    'message' => 'Usuário cadastrado com sucesso!',
                    'user' => $user
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'response' => [
                    'message' => json_decode($e->getMessage())
                ]
            ]);
        }
    }
}
