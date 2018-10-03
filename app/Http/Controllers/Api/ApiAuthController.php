<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
//        $rules = [
//            'email' => 'required|email',
//            'password' => 'required',
//        ];
//
//        $input = $request->only('email', 'password');
//
//        $validator = Validator::make($input, $rules);
//
//        if ($validator->fails()) {
//            $error = $validator->messages()->toJson();
//            return response()->json(['success' => false, 'error' => $error]);
//        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }

        $user = User::where('username',$request->username)->with('admin')->first();
        $auth = Auth::user()->id;
        $users = User::find($auth);
        $users->jwt_token = $token;
        $users->save();

        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('user')
        ];

        return response()->json($respon);
    }
}
