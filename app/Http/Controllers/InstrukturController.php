<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{

    public function __construct()
    {
        $this->middleware('superadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instruktur = Instruktur::all();

        return view('backoffice.administration.instruktur.index', compact('instruktur'));
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
            'nip' => 'required|unique:instruktur,nip',
            'nama' => 'required',
            'gender' => 'required',
            'alamat' => 'required|max:255',
            'kontak' => 'required'
        ]);

        Instruktur::create($validated);

        return response('success',200);
    }

    public function getKelasInstruktur($id)
    {
        $instruktur = Instruktur::whereHas('kelas', function ($q) use($id) {
            $q->where('id_kelas', $id);
        })->with('kelas')->get();

        return $instruktur;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Instruktur $instruktur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instruktur $instruktur)
    {
        $validated = $this->validate($request, [
            'nip' => 'required|unique:instruktur,nip,'. $instruktur->id,
            'nama' => 'required',
            'gender' => 'required',
            'alamat' => 'required|max:255',
            'kontak' => 'required'
        ]);

        $instruktur->update($validated);

        return response('success',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instruktur $instruktur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruktur $instruktur)
    {
        $instruktur->delete();

        return response('success',204);
    }
}
