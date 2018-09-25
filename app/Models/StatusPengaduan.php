<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengaduan extends Model
{
    protected $table = 'status_pengaduan';

    protected $fillable = ['status'];

//    public function timeline()
//    {
//        return $this->hasMany(Timeline::class,'id_status','id');
//    }
    public function pengaduan()
    {
        return $this->belongsToMany(Pengaduan::class,'timeline','id_status','id_pengaduan');
    }
}
