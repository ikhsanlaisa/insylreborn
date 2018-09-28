<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\LayananPengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin as RAdmin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::whereHas('admin')->get();
        return view('backoffice.administration.listadmin', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layanan = LayananPengaduan::all();
        return view('backoffice.administration.add-admin', compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RAdmin $request)
    {
        $validated = $request->validated();

        $validated['id_layanan'] ?? $validated['id_layanan'] = null;


        $user = User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password'])
        ]);

        Admin::create(['id_user' => $user['id']] + $validated);

        return redirect(route('admin.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
