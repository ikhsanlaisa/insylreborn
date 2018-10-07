<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelasResource;
use App\Models\Angkatan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
        $angkatan = Angkatan::all();
        return view('backoffice.administration.kelas.index', compact('kelas', 'angkatan'));
    }

    public function listkelas()
    {
        $all = Kelas::all();

        return KelasResource::collection($all);
    }

    public function getKelas($id)
    {
        $kelas = Kelas::where('id_angkatan', $id)->get();

        return response()->json($kelas);
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
        $validated = $this->validate($request, [
           'id_angkatan' => 'required|exists:angkatan,id',
           'kode' => 'required|string|unique:kelas,kode',
           'nama' => 'required|string'
        ]);

        Kelas::create($validated);

        Session::flash('success', 'Berhasil menambahkan kelas');

        return redirect(route('kelas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
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
    public function update(Request $request, Kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
