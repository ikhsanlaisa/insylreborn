<?php

namespace App\Http\Controllers;

use App\Models\LayananPengaduan;
use App\Models\Pengaduan;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Pengaduan as RPengaduan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pengaduan = Pengaduan::with(['layanan'])->get();
        return view('backoffice.complaint.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.complaint.add', [
            'layanan' => LayananPengaduan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RPengaduan $request)
    {
        $validated = $request->validated();


        $validated['waktu'] = Carbon::now()->setTimezone('+07:00');
        if ($request->hasFile('foto')) {
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

        Session::flash('success', 'Pengaduan berhasil di submit');

        return redirect(route('complaints.index'));

    }

    private function uploadFoto($img)
    {
        $fileName = uniqid() . $img->getClientOriginalName();
        $path = 'uploads/complaints/';

        $fullPath = $path . $fileName;

        Storage::disk('public')->putFileAs($path, $img, $fileName);

        return $fullPath;
    }

    public function onProcess(Request $request)
    {
        $pengaduan = Pengaduan::findOrFail($request['pengaduan_id']);

        $timeline = new Timeline;
        $timeline->fill([
            'id_pengaduan' => $pengaduan['id'],
            'id_status' => 2,
            'waktu' => Carbon::now()->setTimezone('+07:00')
        ])->save();

        Session::flash('success', 'Sukses');
        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Pengaduan $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $complaint)
    {
        $complaint->delete();

        return response('success', 204);
    }
}
