<?php

namespace App\Http\Controllers\Api;

use App\Models\LayananPengaduan;
use App\Models\Pengaduan;


use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Pengaduan as RPengaduan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApiPengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function allpengaduan(){
        $pengaduan = Pengaduan::with('siswa', 'layanan')->orderBy('id','desc')->paginate(10);
//        $timeline = DB::SELECT("
//            Select s.*, t.waktu
//            from status_pengaduan s
//            left join timeline t
//            on s.id = t.id_status
//        ");
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('pengaduan')
        ];
        return response()->json(response($respon));
    }

    public function pengaduanbyuser(){
        $siswa = Auth::user()->siswa->id;
//        $pengaduan = Pengaduan::with('siswa', 'layanan')->where('id_siswa', $siswa)->orderByDesc('id')->get();
        $pengaduans = Pengaduan::with('siswa')->where('id_siswa', $siswa)->get();
//        $timeline = Timeline::with('pengaduan')->where('id_pengaduan', $pengaduans->id);
        $timelines = DB::SELECT("
            select s.*, t.waktu
            from status_pengaduan s
            left join timeline t
            on s.id = t.id_status
            and t.id_pengaduan = ('$pengaduans->id');
        ");

        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('timelines')
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

    public function storepengaduan(RPengaduan $request){
        $validated = $request->validated();
        $validated['waktu'] = Carbon::now()->setTimezone('+07:00');
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

        $timeline = new Timeline;
        $timeline->fill([
            'id_pengaduan' => $pengaduan['id'],
            'id_status' => 1,
            'waktu' => $validated['waktu']
        ])->save();


        if ($pengaduan && $timeline) {
            return response()->json([
                'error' => false,
                'message'=> 'berhasil menyimpan data'
            ]);
        } else {
            return response()->json([
                'error'=>true,
                'message'=>'gagal menyimpan data'
            ]);
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
