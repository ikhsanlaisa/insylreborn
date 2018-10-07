<?php

namespace App\Http\Controllers\Api;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiSurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function showsurvey(){
        $survey = Survey::with(['configInstruktur', 'pertanyaan', 'configIndividu'])->get();

        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('survey')
        ];
        return response()->json(response($respon));
    }
}
