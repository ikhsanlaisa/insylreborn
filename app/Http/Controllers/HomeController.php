<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kelas;
use App\Models\olahraga;
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

        $dashboard['berita'] = Berita::count();
        $dashboard['olahraga'] = olahraga::count();
        $dashboard['user'] = User::where('roles', 2)->count();
        $dashboard['kelas'] = Kelas::count();
        return view('home', compact('dashboard'));
    }

    public function debug()
    {
        $survey = Survey::with(['configInstruktur', 'pertanyaan', 'configIndividu'])->get();

        return $survey;
    }
}
