<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelasResource;
use App\Models\Angkatan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('backoffice.administration.kelas.index', compact('kelas'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas = new Kelas();
        $kelas->nama_kelas = $request->input('nama_kelas');
        $image = $this->uploadFoto($request->file('foto'));
        $kelas->foto = $image;
        $kelas->save();

        Session::flash('success', 'Berhasil menambahkan kelas');

        return redirect(route('kelas.index'));
    }

    private function uploadFoto($img)
    {
        $fileName = uniqid() . $img->getClientOriginalName();
        $path = 'uploads/kelas/';

        $fullPath = $path . $fileName;

        Storage::disk('public')->putFileAs($path, $img, $fileName);

        return $fullPath;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::find($id);

        return response()->json($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);
        if ($request->input('nama_kelas')){
            $kelas->nama_kelas = $request->input('nama_kelas');
        }
        if ($request->hasFile('foto')){
            $image = $this->uploadFoto($request->file('foto'));
            $kelas->foto = $image;

            //Delete Foto Lama
            Storage::disk('public')->delete($kelas['foto']);
        }

        $kelas->save();

        Session::flash('success', 'Kamu Berhasil Memperbarui Kelas');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        Storage::disk('public')->delete($kelas['foto']);

        $kelas->delete();

        return response('success', 204);
    }
}
