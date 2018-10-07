<?php

namespace App\Http\Controllers;

use App\Models\ConfigSurveyIndividu;
use App\Models\ConfigSurveyInstruktur;
use App\Models\JawabanSurvey;
use App\Models\KelasInstruktur;
use App\Models\PertanyaanSurvey;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SurveyController extends Controller
{
    public function index()
    {
//        $tglNow = Carbon::now();
//
//        if (Auth::user()->admin) {
//            $survey = Survey::with(['configInstruktur', 'pertanyaan','configIndividu'])->get();
//        } else {
//            if (Auth::user()['siswa']['kelas']['angkatan']['subdiklat']['diklat']->whereHas('configIndividu')->get() != null) ;
//            {
//                $survey = Survey::with(['configInstruktur', 'pertanyaan'])
//                    ->where('tgl_mulai', '<=', $tglNow->toDateString())
//                    ->where('tgl_selesai', '>=', $tglNow->toDateString())
//                    ->get();
//            }
//        }
        $survey = Survey::with(['configInstruktur', 'pertanyaan', 'configIndividu'])->get();

//        dd($survey);

        return view('backoffice.survey.surveylist', compact('survey'));
    }

    public function create()
    {
        return view('backoffice.survey.add');
    }

    public function store(Request $request)
    {

        if ($request->jenis == 1) {
            $validated = $this->validate($request, [
                'nama' => 'required|string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date',
                'jenis' => 'required',
                'config_survey' => 'required',
                'id_diklat' => '',
                'id_subdiklat' => '',
                'id_angkatan' => '',
                'id_kelas' => '',
                'id_siswa' => '',
                'id_instruktur' => 'exists:instruktur,id',
                'id_tipe_jawaban' => 'exists:tipe_jawaban,id',
                'opsi' => 'required',
                'isian' => 'required'

            ]);

        } else {
            $validated = $this->validate($request, [
                'nama' => 'required|string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date',
                'jenis' => 'required',
                'config_survey' => 'required',
                'id_kelas' => 'required|exists:kelas,id',
                'id_instruktur' => 'exists:instruktur,id',
                'id_tipe_jawaban' => 'exists:tipe_jawaban,id',
                'opsi' => 'required',
                'isian' => 'required'
            ]);
        }

        $validated['tgl_mulai'] = Carbon::parse($request['tgl_mulai']);
        $validated['tgl_selesai'] = Carbon::parse($request['tgl_selesai']);

        $survey = Survey::create($validated);

        if ($request->jenis == 1) {
            if($request->id_siswa != ''){

            }else {
                ConfigSurveyIndividu::create(['id_survey' => $survey['id']] + $validated);
            }
        } else {
            foreach ($validated['id_instruktur'] as $instruktur) {
                $mapel = KelasInstruktur::where('id_instruktur', $instruktur)
                    ->where('id_kelas', $validated['id_kelas'])->first();
                ConfigSurveyInstruktur::create([
                    'id_survey' => $survey['id'],
                    'id_kelas' => $validated['id_kelas'],
                    'id_instruktur' => $instruktur,
                    'mapel' => $mapel['mapel']
                ]);
            }
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

        Session::flash('success','Berhasil Menambahkan Survey');

        return redirect(route('survey.index'));

    }

    public function submission()
    {
        return view('backoffice.survey.submission');
    }

    public function result()
    {
        return view('backoffice.survey.result');
    }
}
