<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function index($email)
    {
        ;
        if (Auth::user()->email != $email) {
            return abort('404');
        }
        $user = User::where('email', $email)->first();

        return view('backoffice.profile.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        if (Auth::user()->email != Auth::user()->email) {
            return abort('404');
        }
        if (Auth::user()->roles == 1) {
            $user = User::find($id);
            if ($request->input('nama')) {
                $user->nama = $request->input('nama');
            }
            if ($request->input('email')) {
                $user->email = $request->input('email');
            }
        }
        $user->save();
        Session::flash('success', 'Berhasil Memperbaharui Profile');
        return redirect()->back();
    }

    public function editPassword($email)
    {
        if (Auth::user()->email != $email) {
            return abort('404');
        }

        $user = User::where('email', $email)->first();
        return view('backoffice.profile.change_password', [
            'user' => $user,
        ]);
    }

    public function updatePassword(UpdatePassword $request, User $user)
    {
        if (Auth::user()->username != $user->username) {
            return abort('404');
        }
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        Session::flash('success', 'Berhasil Memperbaharui Password');
        return redirect()->back();
    }

}
