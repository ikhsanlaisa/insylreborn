<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'survey';

    protected $fillable = [
        'nama', 'tgl_mulai','tgl_selesai'
    ];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanSurvey::class,'id_survey','id');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanSurvey::class,'id_survey','id');
    }

    public function configInstruktur()
    {
        return $this->hasMany(ConfigSurveyInstruktur::class,'id_survey','id');
    }

    public function configIndividu()
    {
        return $this->hasMany(ConfigSurveyIndividu::class,'id_survey', 'id');
    }
}
