<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Berita as News;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Berita::all();

        return view('backoffice.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(News $request)
    {
        $rawNews = $request->all();

        $rawNews['tanggal'] = Carbon::now();

        //Foto
        $image = $request->file('foto');
        $fileName = uniqid() . $image->getClientOriginalName();
        $path = 'uploads/news/';

        Storage::disk('public')->putFileAs($path, $image, $fileName);

        $rawNews['foto'] = $path . $fileName;


        Berita::create($rawNews);

        Session::flash('success', 'Kamu Berhasil Menambahkan Berita');

        return view('backoffice.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Berita $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        Storage::disk('public')->delete($berita['foto']);

        $berita->delete();

        return response('success',204);
    }
}
