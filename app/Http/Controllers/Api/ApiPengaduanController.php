<?php

namespace App\Http\Controllers\Api;

use App\Models\LayananPengaduan;
use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\Timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApiPengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function allpengaduan(){
        $pengaduan = Timeline::with(['pengaduan', 'status'=>allOf()])->orderBy('waktu','desc')->get();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('pengaduan')
        ];
        return response()->json($respon);
    }

    public function pengaduanbyuser(){
        $pengaduan = Pengaduan::where('id_siswa', Auth::user()->siswa->id)->get();
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
        $validated = $request->validated();
        $validated['id_siswa'] = Auth::user()->siswa->id;
        $validated['id_jenis'] = $request->input('id_jenis');
        if ($request->input('isi')) {
            $validated['isi'] = $request->input('isi');
        }
        if ($request->file('foto')) {
            $image = $this->uploadFoto($request->file('foto'));

            $validated['foto'] = $image;
        }
        $pengaduan = Pengaduan::create($validated);
        if ($pengaduan) {
            return response()->json([
                false,
                'berhasil menyimpan data',
                $pengaduan]);
        } else {
            return response()->json([
                true,
                'gagal menyimpan data',
                $pengaduan]);
        }
    }

    private function uploadFoto($img)
    {
        $fileName = uniqid() . $img->getClientOriginalName();
        $path = 'uploads/complaints/';

        $fullPath = $path . $fileName;

        Storage::disk('public')->putFileAs($path, $img, $fileName);

        return $fullPath;
    }
}
