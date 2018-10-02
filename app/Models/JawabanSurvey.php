<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanSurvey extends Model
{
    protected $table = 'jawaban_survey';

    protected $fillable = [
        'id_survey','id_config_instruktur','id_siswa'
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class,'id_survey','id');
    }

    public function configInstruktur()
    {
        return $this->belongsTo(ConfigSurveyInstruktur::class,'id_config_instruktur','id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa','id');
    }

    public function detailJawaban()
    {
        return $this->hasMany(DetailJawaban::class,'id_jawaban_survey','id');
    }
}
