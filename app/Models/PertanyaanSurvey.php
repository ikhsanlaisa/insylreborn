<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanSurvey extends Model
{
    protected $table = 'pertanyaan_survey';

    protected $fillable = [
        'isi','id_tipe_jawaban','id_survey'
    ];

    public function tipeJawaban()
    {
        return $this->belongsTo(TipeJawaban::class,'id_tipe_jawaban','id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class,'id_survey','id');
    }
}
