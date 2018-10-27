<?php

namespace App\Http\Controllers;

use App\Models\kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontak = kontak::all();
        return view('backoffice.kontak.index', compact('kontak'));
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
        $kontak = new kontak();
        $kontak->nama = $request->input('nama');
        $kontak->email = $request->input('email');
        $kontak->no_telp = $request->input('no_telp');
        $image = $this->uploadFoto($request->file('foto'));
        $kontak->foto = $image;
        $kontak->save();

        Session::flash('success', 'Berhasil menambahkan kontak');

        return redirect(route('kontak.index'));
    }

    private function uploadFoto($img)
    {
        $fileName = uniqid() . $img->getClientOriginalName();
        $path = 'uploads/kontak/';

        $fullPath = $path . $fileName;

        Storage::disk('public')->putFileAs($path, $img, $fileName);

        return $fullPath;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontak = kontak::find($id);

        return response()->json($kontak);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit(kontak $kontak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelas = kontak::find($id);
        if ($request->input('nama')){
            $kelas->nama = $request->input('nama');
        }
        if ($request->input('email')){
            $kelas->email = $request->input('email');
        }
        if ($request->input('no_telp')){
            $kelas->no_telp = $request->input('no_telp');
        }
        if ($request->hasFile('foto')){
            $image = $this->uploadFoto($request->file('foto'));
            $kelas->foto = $image;

            //Delete Foto Lama
            Storage::disk('public')->delete($kelas['foto']);
        }

        $kelas->save();

        Session::flash('success', 'Kamu Berhasil Memperbarui Kontak');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = kontak::findOrFail($id);

        Storage::disk('public')->delete($kelas['foto']);

        $kelas->delete();

        return response('success', 204);
    }
}
