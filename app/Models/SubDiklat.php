<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDiklat extends Model
{
    protected $table = 'subdiklat';

    protected $fillable = [
        'id_diklat', 'kode', 'nama'
    ];

    public function diklat()
    {
        return $this->belongsTo(Diklat::class,'id_diklat','id');
    }

    public function angkatan()
    {
        return $this->hasMany(Angkatan::class,'id_subdiklat','id');
    }

    public function configIndividu()
    {
        return $this->hasMany(ConfigSurveyIndividu::class,'id_subdiklat','id');
    }
}
