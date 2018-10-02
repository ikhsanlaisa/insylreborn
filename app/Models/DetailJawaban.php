<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailJawaban extends Model
{
    protected $table = 'detail_jawaban';

    protected $fillable = [
        'id_jawaban_survey','id_pertanyaan','id_opsi_jawaban'
    ];

    public function jawabanSurvey()
    {
        return $this->belongsTo(JawabanSurvey::class,'id_jawaban_survey','id');
    }

    public function pertanyaanSurvey()
    {
        return $this->belongsTo(PertanyaanSurvey::class,'id_pertanyaan','id');
    }

    public function opsiJawaban()
    {
        return $this->belongsTo(OpsiJawaban::class,'id_opsi_jawaban','id');
    }
}
