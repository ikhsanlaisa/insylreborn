<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigSurveyInstruktur extends Model
{
    protected $table = 'config_survey_instruktur';

    protected $fillable = [
        'id_survey','id_kelas','id_instruktur','mapel'
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class,'id_survey','id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id_kelas','id');
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class,'id_instruktur','id');
    }

    public function jawabanSurvey()
    {
        return $this->hasMany(JawabanSurvey::class,'id_config_instruktur','id');
    }
}
