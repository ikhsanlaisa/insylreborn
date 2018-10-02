<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    protected $table = 'diklat';

    protected $fillable = [
        'kode', 'nama'
    ];

    public function subdiklat()
    {
        return $this->hasMany(SubDiklat::class,'id_diklat','id');
    }

    public function configIndividu()
    {
        return $this->hasMany(ConfigSurveyIndividu::class,'id_diklat','id');
    }
}
