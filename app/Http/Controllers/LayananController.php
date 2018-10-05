<?php

namespace App\Http\Controllers;

use App\Models\LayananPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = LayananPengaduan::all();
        return view('backoffice.administration.service', compact('layanan'));
    }

    public function listlayanan()
    {
        $all = LayananPengaduan::all();

        return response()->json($all);
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
            'jenis' => 'required|string'
        ]);

        LayananPengaduan::create($validated);

        return response('success',200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LayananPengaduan  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LayananPengaduan $kategori)
    {
        $validated = $this->validate($request, [
            'jenis' => 'required|string'
        ]);

        $kategori->update($validated);

        Session::flash('success', 'Berhasil Memperbaharui Kategori Layanan');
        return response('success',200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayananPengaduan  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(LayananPengaduan $kategori)
    {
        $kategori->delete();

        return response('success', 204);
    }
}
