<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    protected $table = 'instruktur';

    protected $fillable = [
        'nip','nama','alamat','kontak','gender'
    ];

    public function configInstruktur()
    {
        return $this->hasMany(ConfigSurveyInstruktur::class,'id_survey','id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class,'kelas_instruktur','id_instruktur','id_kelas')->withPivot('id');
    }
}
