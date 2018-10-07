<?php

namespace App\Http\Controllers\Api;

use App\Models\PertanyaanSurvey;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiSurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function surveyindividu(){
        $siswa = Auth::user()->siswa->id;
//        $survey = Survey::with(['configInstruktur', 'pertanyaan', 'configIndividu'])->get();
        $pasis = collect(DB::select("
        select s.id as id_siswa, k.id as id_kelas, a.id 
        as id_angkatan, sd.id as id_subdiklat, d.id 
        as id_diklat from siswa s join kelas k 
        on s.id_kelas = k.id join angkatan a 
        on k.id_angkatan = a.id join subdiklat sd 
        on a.id_subdiklat = sd.id join diklat d 
        on sd.id_diklat = d.id where s.id = ('$siswa');
        "))->first();

        $datasurvey = DB::select("
            select s.* from survey s join config_survey_individu ci
            where ci.id_siswa = ('$pasis->id_siswa')
            or ci.id_kelas = ('$pasis->id_kelas')
            or ci.id_angkatan = ('$pasis->id_angkatan')
            or ci.id_subdiklat = ('$pasis->id_subdiklat')
            or ci.id_diklat = ('$pasis->id_diklat');
        ");
        $survey = array();
        foreach($datasurvey as $item) {
            $newData = $item;
            $newData->pertanyaan = PertanyaanSurvey::where('id_survey', $item->id)->get();
            array_push($survey,$newData);
        }
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('survey')
        ];
        return response()->json($respon);
    }
}
