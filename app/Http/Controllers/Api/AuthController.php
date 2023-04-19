<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(ApiLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {

                return message(false , [] , 'Login credentials are invalid.' , 400);
            }
        } catch (JWTException $e) {
            return message(false , [] , 'Could not create token.' , 500);

        }

        return message(true , ['user'=>new UserResource(auth()->user()) , 'token'=>$token] , null , 200);

    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return message(true , [] , 'Logout' , 200);
        } catch (JWTException $exception) {
            return message(false , [] , 'Sorry, user cannot be logged out' , 500);

        }

    }

    public function get_user()
    {
        $user = auth()->user();
        return message(true , ['data'=>new UserResource($user)] , null , 200);
    }
}
