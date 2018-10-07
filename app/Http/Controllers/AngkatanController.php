<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $angkatan = Angkatan::all();
        return view('backoffice.administration.angkatan.index', compact('angkatan'));
    }

    public function listangkatan()
    {
        $all = Angkatan::all();

        return response()->json($all);
    }

    public function getAngkatan($id)
    {
        $angkatan = Angkatan::where('id_subdiklat', $id)->get();

        return response()->json($angkatan);
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
            'kode' => 'required|unique:angkatan,kode',
            'id_subdiklat' => 'required|exists:subdiklat,id',
            'periode_awal' => 'required',
            'periode_akhir' => 'required',
        ]);

        Angkatan::create($validated);


        return response('success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Angkatan $angkatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Angkatan $angkatan)
    {
        $validated = $this->validate($request, [
           'kode' => 'required|unique:angkatan,kode,'.$angkatan->id,
           'id_subdiklat' => 'required|exists:subdiklat,id',
           'periode_awal' => 'required',
           'periode_akhir' => 'required',
        ]);

        $angkatan->update($validated);


        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angkatan $angkatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angkatan $angkatan)
    {
        $angkatan->delete();


        return response('success',204);
    }
}
