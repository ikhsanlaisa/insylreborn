<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    protected $table = 'angkatan';

    protected $fillable = [
        'id_subdiklat', 'kode', 'nama'
    ];

    public function subdiklat()
    {
        return $this->belongsTo(SubDiklat::class,'id_subdiklat','id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class,'id_angkatan','id');
    }
}
