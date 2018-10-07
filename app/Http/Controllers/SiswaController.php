<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::active()->whereHas('siswa')->get();

        return view('backoffice.administration.siswa.index', compact('users'));
    }

    public function listsiswa()
    {
        if (Auth::user()->admin) {
            $siswa = Siswa::all();

            return SiswaResource::collection($siswa);
        }

        return abort(404);
    }

    public function getSiswa($id)
    {
        $siswa = Siswa::where('id_kelas', $id)->get();

        return response()->json($siswa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.administration.siswa.add');
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
            'username' => 'required|regex:/^[a-z]+$/|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5',
            'nit' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id',
            'nama' => 'required|string',
            'gender' => 'string',
            'alamat' => 'string',
            'kontak' => 'string',
            'tanggal_lahir' => 'string'
        ]);

        $user = User::create(['password' => bcrypt($validated['password'])] + $validated);

        Siswa::create(['id_user' => $user['id']] + $validated);


        Session::flash('success', 'Sukses Membuat Akun Admin');

        return redirect(route('siswa.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(User $siswa)
    {
        return view('backoffice.administration.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Siswa $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $siswa)
    {
        $user = $siswa;

        $validated = $this->validate($request, [
            'username' => 'required|regex:/^[a-z]+$/|unique:users,username,' . $user['id'],
            'nit' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id',
            'nama' => 'required|string',
            'gender' => 'string',
            'alamat' => 'string',
            'kontak' => 'string',
            'tanggal_lahir' => 'string'
        ]);

        if ($validated['username'] != null) {
            $user->update([
                'username' => $validated['username'],
            ]);
        }

        $user->siswa->update($validated);

        Session::flash('success', 'Sukses Memperbaharui Akun Siswa');
        return redirect(route('siswa.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $siswa)
    {
        $siswa->delete();

        return response('success', 204);
    }
}
