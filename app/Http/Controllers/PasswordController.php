<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    public function __construct()
    {
        $id = Route::current()->getParameter('id');

        if(Auth::user()->id !== $id){
            abort('404');
        }
    }

    public function editPassword($id)
    {
        $user = User::findOrFail($id);

        return;
    }

    public function updatePassword(UpdatePassword $request, User$user)
    {
        $user->update([
            'password' => bcrypt($request->new_password)
        ]);

        Session::flash('success', 'Sukses Memperbaharui Password');

        return redirect()->back();
    }
}
