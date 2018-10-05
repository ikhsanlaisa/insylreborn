<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class ProfileController extends Controller
{

    public function index($username)
    {
        if(Auth::user()->username != $username)
        {
            return abort('404');
        }
        $user = User::where('username', $username)->first();

        return view('backoffice.profile.profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        if(Auth::user()->username != $user->username)
        {
            return abort('404');
        }
        if ($user->admin) {
            $validated = $this->validate($request, [
                'nama' => 'required|string',
                'username' => 'required|regex:/^[a-z]+$/|unique:users,username,' . $user->id,
            ]);

            $user->update($validated);
            $user->admin->update($validated);
        }else {
            $validated = $this->validate($request,[
                'username' => 'required|regex:/^[a-z]+$/|unique:users,username,' . $user['id'],
                'gender' => 'string',
                'alamat' => 'string',
                'kontak' => 'string',
                'tanggal_lahir' => 'string'
            ]);

            $user->update($validated);
            $user->siswa->update($validated);
        }

        Session::flash('success', 'Berhasil Memperbaharui Profile');
        return redirect()->back();
    }

    public function editPassword($username)
    {
        if(Auth::user()->username != $username)
        {
            return abort('404');
        }

        $user = User::where('username', $username)->first();
        return view('backoffice.profile.change_password', [
            'user' => $user,
        ]);
    }

    public function updatePassword(UpdatePassword $request, User $user)
    {
        if(Auth::user()->username != $user->username)
        {
            return abort('404');
        }
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        Session::flash('success', 'Berhasil Memperbaharui Password');
        return redirect()->back();
    }

}
