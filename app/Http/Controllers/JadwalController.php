<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\Kelas;
use App\Models\olahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = jadwal::all();
        $kelas = kelas::all();
        $cabor = olahraga::all();
        return view('backoffice.jadwal.index')->with(['jadwal' => $jadwal,'kelas' => $kelas, 'cabor' => $cabor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jadwal = new jadwal();
        $jadwal->tim1 = $request->input('tim1');
        $jadwal->tim2 = $request->input('tim2');
        $jadwal->lokasi = $request->input('lokasi');
        $jadwal->date_time = $request->input('date_time');
        $jadwal->olahraga_id = $request->input('olahraga_id');
        $jadwal->save();

        Session::flash('success', 'Berhasil menambahkan jadwal');

        return redirect(route('jadwal.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = jadwal::find($id);

        return response()->json($jadwal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwal = jadwal::find($id);
        if ($request->input('tim1')){
            $jadwal->tim1 = $request->input('tim1');
        }
        if ($request->input('tim2')){
            $jadwal->tim2 = $request->input('tim2');
        }
        if ($request->input('lokasi')){
            $jadwal->lokasi = $request->input('lokasi');
        }
        if ($request->input('date_time')){
            $jadwal->date_time = $request->input('date_time');
        }
        if ($request->input('olahraga_id')){
            $jadwal->olahraga_id = $request->input('olahraga_id');
        }

        $jadwal->save();

        Session::flash('success', 'Kamu Berhasil Memperbarui Jadwal');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = jadwal::findOrFail($id);

        $jadwal->delete();

        return response('success', 204);
    }
}
