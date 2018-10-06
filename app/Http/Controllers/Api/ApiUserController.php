<?php

namespace App\Http\Controllers\Api;

use App\Models\Siswa;
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
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('siswa')
        ];
        return response()->json($respon);
    }
}
