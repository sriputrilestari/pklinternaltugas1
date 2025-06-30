<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|unique:users|max:255',
            'password'  => 'required|string|min:8',
        ]);

        //jika validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 501);
        }

        //membuat akun user baru
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        //membuat reaspon json
        return response()->json([
            'success'   => true,
            'data'      => $user,
            'message'   => 'akun berhasil dibuat',
        ], 201);
    }

    public function login(Request $request)
        {
            if (! Auth::attempt($request->only('email', 'password')))
            {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();
            //membuat auth_token
            $token = $user->createToken('aouth_token')->plainTextToken;

            return response()->json([
                'message'       => 'Login Berhasil',
                'access_token'  => $token,
                'token_type'    =>'Bearer Token',
            ], 200);
        }

        public function logout()
        {
            Auth::user()->tokens()->delete();
            return response()->json([
                'message' => 'Logout Berhasil',
            ], 200);
        }
}
