<?php

namespace App\Http\Controllers;

use App\Models\ConfigSurveyIndividu;
use App\Models\JawabanSurvey;
use App\Models\PertanyaanSurvey;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $tglNow = Carbon::now();

        if (Auth::user()->admin) {
            $survey = Survey::with(['configInstruktur', 'pertanyaan'])->get();
        } else {
            if (Auth::user()['siswa']['kelas']['angkatan']['subdiklat']['diklat']->whereHas('configIndividu')->get() != null) ;
            {
                $survey = Survey::with(['configInstruktur', 'pertanyaan'])
                    ->where('tgl_mulai', '<=', $tglNow->toDateString())
                    ->where('tgl_selesai', '>=', $tglNow->toDateString())
                    ->get();
            }
        }
        return dd(Auth::user()['siswa']['kelas']['angkatan']['subdiklat']['diklat']);
        return view('backoffice.survey.surveylist');
    }

    public function create()
    {
        return view('backoffice.survey.add');
    }

    public function store(Request $request)
    {
        $validated = $request->all();

        $validated['tgl_mulai'] = Carbon::parse($request['tgl_mulai']);
        $validated['tgl_selesai'] = Carbon::parse($request['tgl_akhir']);

        $survey = Survey::create($validated);

        if ($request->jenis == 1) {
            ConfigSurveyIndividu::create($validated);
        }

        foreach ($validated['opsi'] as $opsi) {
            PertanyaanSurvey::create([
                'id_survey' => $survey['id'],
                'isi' => $opsi,
                'id_tipe_jawaban' => $validated['id_tipe_jawaban']
            ]);
        }

        foreach ($validated['isian'] as $isian) {
            PertanyaanSurvey::create([
                'id_survey' => $survey['id'],
                'isi' => $isian,
                'id_tipe_jawaban' => 3
            ]);
        }

        return "Berhasil";

    }
}
