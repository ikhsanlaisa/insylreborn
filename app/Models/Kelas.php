<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'id_angkatan', 'kode', 'nama'
    ];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class,'id_angkatan','id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class,'id_kelas','id');
    }

    public function instruktur()
    {
        return $this->belongsToMany(Instruktur::class,'kelas_instruktur','id_kelas','id_instruktur')->withPivot('mapel');
    }

    public function configInstruktur()
    {
        return $this->hasMany(ConfigSurveyInstruktur::class,'id_kelas','id');
    }

    public function configIndividu()
    {
        return $this->hasMany(ConfigSurveyIndividu::class,'id_kelas','id');
    }
}
