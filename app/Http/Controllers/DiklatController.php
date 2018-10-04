<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\DiklatResource;

class DiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diklat = Diklat::all();

        return view('backoffice.administration.diklat.index', compact('diklat'));
    }

    public function listdiklat()
    {
        $diklat = Diklat::all();

        return DiklatResource::collection($diklat);
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
            'kode' => 'required|unique:diklat,kode',
            'nama' => 'required|string'
        ]);

        Diklat::create($validated);

        Session::flash('success', 'Diklat berhasil di tambahkan');

        return response('success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diklat $diklat)
    {
        $validated = $this->validate($request, [
            'kode' => 'required|unique:diklat,kode,' . $diklat->id,
            'nama' => 'required|string'
        ]);

        $diklat->update($validated);

        Session::flash('success', 'Diklat berhasil di perbaharui');
        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diklat $diklat)
    {
        $diklat->delete();

        Session::flash('success', 'Diklat berhasil di hapus');

        return response('succes',204);
    }
}
