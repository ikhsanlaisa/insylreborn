<?php

namespace App\Http\Controllers;

use App\Models\olahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OlahragaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabor = olahraga::all();
        return view('backoffice.cabor.index', compact('cabor'));
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
        $kelas = new olahraga();
        $kelas->cabang_olahraga = $request->input('cabang_olahraga');
        $kelas->pj = $request->input('pj');
        $kelas->save();

        Session::flash('success', 'Berhasil menambahkan kelas');

        return redirect(route('cabor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\olahraga  $olahraga
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cabor = olahraga::find($id);

        return response()->json($cabor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\olahraga  $olahraga
     * @return \Illuminate\Http\Response
     */
    public function edit(olahraga $olahraga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\olahraga  $olahraga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cabor = olahraga::find($id);
        if ($request->input('cabang_olahraga')){
            $cabor->cabang_olahraga = $request->input('cabang_olahraga');
        }
        if ($request->input('pj')){
            $cabor->pj = $request->input('pj');
        }
        $cabor->save();

        Session::flash('success', 'Kamu Berhasil Memperbarui Cabor');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\olahraga  $olahraga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cabor = olahraga::findOrFail($id);

        $cabor->delete();

        return response('success', 204);
    }
}
