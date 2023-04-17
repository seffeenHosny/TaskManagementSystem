<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);

            return message(false , [] , ['error' => $validator->messages()] , 422);

        }

        //Request is validated
        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                
                return message(false , [] , 'Login credentials are invalid.' , 400);

            }
        } catch (JWTException $e) {
            return $credentials;


            return message(false , [] , 'Could not create token.' , 500);

        }

        return message(true , ['user'=>new UserResource(auth()->user()) , 'token'=>$token] , null , 200);

    }

    public function logout(Request $request)
    {
        auth()->logout();
        return message(true , [] , 'Logout' , 200);
    }

    public function get_user()
    {
        $user = auth()->user();
        return message(true , ['data'=>new UserResource($user)] , null , 200);
    }
}
