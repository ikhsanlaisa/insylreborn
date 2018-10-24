<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengaduan;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $dashboard['berita'] = Berita::count();
//        $dashboard['user'] = User::where('roles' == 1)->count();
//        $dashboard['pengaduan'] = Pengaduan::count();

        return view('home');
    }

    public function debug()
    {
        $survey = Survey::with(['configInstruktur', 'pertanyaan', 'configIndividu'])->get();

        return $survey;
    }
}
