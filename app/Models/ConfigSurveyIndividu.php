<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigSurveyIndividu extends Model
{
    protected $table = 'config_survey_individu';

    protected $fillable = [
        'id_diklat','id_subdiklat','id_angkatan','id_kelas','id_siswa','id_survey',
    ];

    public function diklat()
    {
        return $this->belongsTo(Diklat::class,'id_diklat','id');
    }

    public function subdiklat()
    {
        return $this->belongsTo(SubDiklat::class,'id_subdiklat','id');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class,'id_angkatan','id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id_kelas','id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa','id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class,'id_survey','id');
    }

}
