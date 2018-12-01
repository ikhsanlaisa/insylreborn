<?php

namespace App\Http\Controllers\Api;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function profil(){
//        $token = $request->header('Authorization');
////        $tk = str_ireplace('bearer ', '', $token);
//        $user = User::where('jwt_token', $token)->first();
//        if ($user) {
            $user = User::where('id', Auth::user()->id)->first();
            return response()->json($user);
//        }else{
//            return response()->json([
//               'message' => 'Token Invalid'
//            ]);
//        }
    }
}
