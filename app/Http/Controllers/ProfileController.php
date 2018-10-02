<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index($username)
    {
        $user = User::where('username', $username)->first();

        return view('backoffice.profile.profile', compact('user'));
    }
}
