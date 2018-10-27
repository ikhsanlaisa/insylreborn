<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\Kelas;
use App\Models\pertandingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PertandinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = pertandingan::with('tim1_detail', 'tim2_detail', 'cabor_detail')->get();
        $jadwal = jadwal::all();
        return view('backoffice.result.index')->with(['result'=>$result, 'jadwal'=>$jadwal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $score = new pertandingan();
        $score->jadwal_id = $request->input('jadwal');
        $score->cabor = $request->input('caborid');
        $score->tim1 = $request->input('tim1id');
        $score->tim2 = $request->input('tim2id');
        $score->keterangan = $request->input('keterangan');
        $score->lokasi = $request->input('lokasis');
        $score->score = $request->input('score');
        $result1 = $score->save();

        $id = $request->input('win');
        $kelas = Kelas::find($id);
        $kelas->point = $kelas->point+3;
        $result2 = $kelas->save();
        if ($result1 && $result2) {
            Session::flash('success', 'Berhasil menambahkan Hasil Pertandingan');

            return redirect(route('result.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pertandingan  $pertandingan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jad = jadwal::find($id);
        $tim1 = $jad->kelas()->first();
        $tim2 = $jad->kelas1()->first();
        $cabor = $jad->cb_olahraga()->first();
        $all = [
            "tim1"=>$tim1,
            "tim2"=>$tim2
        ];
        $returnJSON = [
            "jadwal"=>$jad,
            "tim1"=>$tim1,
            "tim2"=>$tim2,
            "cabor"=>$cabor,
            "all"=>$all
        ];

        return json_encode($returnJSON);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pertandingan  $pertandingan
     * @return \Illuminate\Http\Response
     */
    public function edit(pertandingan $pertandingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pertandingan  $pertandingan
     * @return \Illuminate\Http\Response
     */

    public function shows($id){
        $scr = pertandingan::find($id);
        $jad = $scr->jadwal()->first();
        $k = $jad->kelas()->first();
        $k1 = $jad->kelas1()->first();
        $c = $jad->cb_olahraga()->first();
        $data = [
            "scr" => $scr,
            "jad" => $jad,
            "c"=>$c,
            "k"=>$k,
            "k1"=>$k1
        ];
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $sc = pertandingan::find($id);
        $sc->score = $request->input('scores');
        $sc->keterangan = $request->input('ket');
        $sc->save();
        Session::flash('success', 'Kamu Berhasil Memperbarui Hasil Pertandingan');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pertandingan  $pertandingan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $score = pertandingan::find($id);
        $score->delete();

        return response('success', 204);
    }
}
