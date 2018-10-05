<?php

namespace App\Http\Controllers;

use App\Models\SubDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdiklat = SubDiklat::all();

        return view('backoffice.administration.subdiklat.index', compact('subdiklat'));
    }

    public function listsubdiklat()
    {
        $all = SubDiklat::all();

        return response()->json($all);
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
        $validated = $this->validate($request, [
            'id_diklat' => 'required|exists:diklat,id',
            'kode' => 'required|unique:subdiklat,kode',
            'nama' => 'required|string'
        ]);

        SubDiklat::create($validated);

        Session::flash('success', 'Diklat berhasil di tambahkan');

        return response('success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubDiklat  $subdiklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubDiklat $subdiklat)
    {
        $validated = $this->validate($request, [
            'id_diklat' => 'required|exists:diklat,id',
            'kode' => 'required|unique:subdiklat,kode,' . $subdiklat->id,
            'nama' => 'required|string'
        ]);

        $subdiklat->update($validated);

        Session::flash('success', 'Sub Diklat berhasil di perbaharui');


        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubDiklat  $subdiklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubDiklat $subdiklat)
    {
        $subdiklat->delete();

        Session::flash('success', 'Sub Diklat berhasil di hapus');

        return response('success', 204);
    }
}
