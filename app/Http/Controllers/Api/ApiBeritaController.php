<?php

namespace App\Http\Controllers\Api;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiBeritaController extends Controller
{
    public function news(){
        $news = Berita::all();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('news')
        ];
        return response()->json($respon);
    }
}
