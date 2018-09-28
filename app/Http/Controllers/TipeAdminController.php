<?php

namespace App\Http\Controllers;

use App\Models\TipeAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\TipeAdmin as Tipe;

class TipeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipeadmin = TipeAdmin::all();

        return view('backoffice.administration.tipeadmin', compact('tipeadmin'));
    }

    public function listTipeAdmin()
    {
        $tipeadmin = TipeAdmin::all();
        return Tipe::collection($tipeadmin);

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
            'tipe' => 'required|string'
        ]);

        TipeAdmin::create($validated);

        Session::flash('success', 'Berhasil Menambahkan Tipe Admin');
        return response('success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\TipeAdmin $tipeadmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipeAdmin $tipeadmin)
    {
        $validated = $this->validate($request, [
            'tipe' => 'required|string'
        ]);

        $tipeadmin->update($validated);

        Session::flash('success', 'Berhasil Memperbaharui Tipe Admin');
        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipeAdmin $tipeadmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipeAdmin $tipeadmin)
    {
        $tipeadmin->delete();

        return response('success', 204);
    }
}
