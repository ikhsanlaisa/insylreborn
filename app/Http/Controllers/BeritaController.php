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
        $rawNews = $request->validated();

        $rawNews['tanggal'] =  Carbon::now()->setTimezone('+07:00');
        $image = $this->uploadFoto($request->file('foto'));
        $rawNews['foto'] = $image;

        Berita::create($rawNews);

        Session::flash('success', 'Kamu Berhasil Menambahkan Berita');

        return redirect(route('news.index'));
    }

    private function uploadFoto($img)
    {
        $fileName = uniqid() . $img->getClientOriginalName();
        $path = 'uploads/news/';

        $fullPath = $path . $fileName;

        Storage::disk('public')->putFileAs($path, $img, $fileName);

        return $fullPath;
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
    public function edit(Berita $news)
    {
        return view('backoffice.news.edit', [
            'berita' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Berita $berita
     * @return \Illuminate\Http\Response
     */
    public function update(News $request, Berita $news)
    {
        $rawNews = $request->all();

        if ($request->hasFile('foto')){
            $image = $this->uploadFoto($request->file('foto'));
            $rawNews['foto'] = $image;

            //Delete Foto Lama
            Storage::disk('public')->delete($news['foto']);
        }

        $news->update($rawNews);


        Session::flash('success', 'Kamu Berhasil Memperbarui Berita');

        return redirect()->back();
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

        return response('success', 204);
    }
}
