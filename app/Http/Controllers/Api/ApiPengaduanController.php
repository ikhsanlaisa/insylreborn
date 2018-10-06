<?php

namespace App\Http\Controllers\Api;

use App\Models\LayananPengaduan;
use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\StatusPengaduan;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApiPengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function allpengaduan(){
        $pengaduan = Timeline::with('pengaduan')->orderBy('waktu','desc')->paginate(10);
        $timeline = DB::SELECT("
            Select s.*, t.waktu 
            from status_pengaduan s 
            left join timeline t 
            on s.id = t.id_status 
        ");
//        $result = [
//            'pengaduan'=>$pengaduan,
//            'timeline'=>$timeline
//        ];
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('pengaduan', 'timeline')
        ];
        return response()->json(response($respon));
    }

    public function pengaduanbyuser(){
        $pengaduan = Pengaduan::where('id_siswa', Auth::user()->siswa->id)->first();
//        $timeline = Timeline::with('pengaduan')->with('status')->where('id_pengaduan', $pengaduan->id)->paginate(10);
        $timelines = DB::SELECT("
            select s.*, t.waktu 
            from status_pengaduan s 
            left join timeline t 
            on s.id = t.id_status 
            and t.id_pengaduan = ('$pengaduan');
        ");

        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('pengaduan','timelines')
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
                false,
                'berhasil menyimpan data',
                $pengaduan, $timeline]);
        } else {
            return response()->json([
                true,
                'gagal menyimpan data',
                $pengaduan, $timeline]);
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
