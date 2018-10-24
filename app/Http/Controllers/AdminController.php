<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\LayananPengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin as RAdmin;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
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
        $admin = User::where('roles', 1)->get();
        return view('backoffice.administration.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.administration.admin.add');
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
//        User::create([
//            'nama' => $validated['nama'],
//            'email' => $validated['email'],
//            'password' => bcrypt($validated['password']),
//
//        ]);
        $user = new User();
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->password =bcrypt($validated['password']);
        $user->roles = 1;
        $user->save();

        Session::flash('success', 'Sukses Membuat Akun Admin');

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
    public function edit(User $admin)
    {
        $layanan = LayananPengaduan::all();

        return view('backoffice.administration.admin.edit', compact(['admin', 'layanan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
//        $user = $admin;
//
//        $validated = $this->validate($request, [
//            'username' => 'required|regex:/^[a-z]+$/|unique:users,username,' . $user['id'],
//            'id_tipe' => 'required|exists:tipe_admin,id',
//            'id_layanan' => 'exists:layanan_pengaduan,id',
//            'nip' => 'required|string',
//            'nama' => 'required|string',
//        ]);
//
//        $validated['id_layanan'] ?? $validated['id_layanan'] = null;
//
//        if ($validated['username'] != null) {
//            $user->update([
//                'username' => $validated['username'],
//            ]);
//        }
//
//        $user->admin->update(['id_user' => $user['id']] + $validated);
//
//        Session::flash('success', 'Sukses Memperbaharui Akun Admin');
//        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        return response('success', 204);
    }
}
