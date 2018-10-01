<?php

namespace App\Http\Controllers\Api;

use App\Models\LayananPengaduan;
use App\Models\Pengaduan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiPengaduanController extends Controller
{
    public function allpengaduan(){
        $pengaduan = Pengaduan::all();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('pengaduan')
        ];
        return response()->json($respon);
    }

    public function pengaduanbyuser(){
        $pengaduan = Pengaduan::where(Auth::user()->id)->first();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('pengaduan')
        ];
        return response()->json($respon);
    }

    public function addpengaduan(){
        $layanan = LayananPengaduan::all();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('layanan')
        ];
        return response()->json($respon);
    }

    public function storepengaduan(Request $request){
        $siswa = Siswa::where(Auth::user()->id);
        $filepath = 'images';
        $pengaduan = new Pengaduan();
        $pengaduan->id_siswa = $siswa->id;
        $pengaduan->id_jenis = $request->input('id_jenis');
        if ($request->input('isi')) {
            $pengaduan->isi = $request->input('isi');
        }
        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotos = $foto->getClientOriginalName();
            $foto->move($filepath, $fotos);

            $pengaduan->foto = $fotos;
        }
        if ($pengaduan->save()) {
            return response()->json([
                false,
                'berhasil',
                $pengaduan]);
        } else {
            return response()->json([
                true,
                'gagal membuat booking',
                $pengaduan]);
        }
    }
}
