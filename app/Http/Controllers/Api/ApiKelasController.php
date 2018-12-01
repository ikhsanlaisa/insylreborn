<?php

namespace App\Http\Controllers\Api;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiKelasController extends Controller
{
    public function kelas(){
        $kelas = Kelas::all();
        return response()->json($kelas);
    }
}
