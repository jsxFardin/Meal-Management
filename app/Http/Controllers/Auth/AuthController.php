<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {

        try {
            $user = User::where('username', $request->username)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->sendError('The provided credentials are incorrect', JsonResponse::HTTP_UNAUTHORIZED);
            }

            $output = [
                'token' => $user->createToken($request->device_name)->plainTextToken,
                'user'  => $user
            ];

            return $this->sendSuccess(__('auth.welcome', ['name' => $user->name]), JsonResponse::HTTP_OK, $output);
        } catch (\Exception $error) {
            return $this->sendError($error->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $error);
        }
    }

    public function logout(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email'
            ]);
        
            $user = $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            
            return $this->sendSuccess(__('auth.logout'), JsonResponse::HTTP_OK);
        } catch (\Exception $error) {
            return $this->sendError($error->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $error);
        }
    }
}
