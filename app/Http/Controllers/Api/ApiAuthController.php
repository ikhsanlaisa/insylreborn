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
    public function register(Request $request)
    {
        $credentials = $request->only('nama', 'email', 'password', 'kelas_id', 'roles');

        $rules = [
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name = $request->nama;
        $email = $request->email;
        $password = $request->password;
        $kelas = $request->kelas_id;
        $roles = $request->roles = 2;

        User::create(['nama' => $name, 'email' => $email, 'kelas_id' => $kelas, 'roles' => $roles, 'password' => bcrypt($password)]);
        return response()->json(['success' => true, 'message' => 'Thanks for signing up!.']);
    }

//    public function login(Request $request)
//    {
//        $credentials = [
//            'username' => $request->username,
//            'password' => $request->password
//        ];
//
//        try {
//            // attempt to verify the credentials and create a token for the user
//            if (!$token = JWTAuth::attempt($credentials)) {
//                return response()->json(['success' => false, 'error' => 'Invalid Credentials.'], 401);
//            }
//        } catch (JWTException $e) {
//            // something went wrong whilst attempting to encode the token
//            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
//        }
//
//        $user = User::where('username',$request->username)->with('siswa')->first();
////        var_dump($user);
//        $auth = Auth::user()->id;
//        $users = User::find($auth);
//        $users->jwt_token = $token;
//        $users->save();
//
//        $respon = [
//            'error' => false,
//            'message' => "success",
//            'data' => compact('token','user')
//        ];
//
//        return response()->json($respon);
//    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email', 'password');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success' => false, 'error' => $error]);
        }

        $credentials = [
            'email' => $request->email,
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

        $user = User::where('email',$request->email)->first();
//        var_dump($user);
        $auth = Auth::user()->id;
        $users = User::find($auth);
        $users->jwt_token = $token;
        $users->save();

        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('token','user')
        ];

        return response()->json($respon);
        // all good so return the token
//        return response()->json(['success' => true, 'data' => ['token' => $token]]);
    }
}
