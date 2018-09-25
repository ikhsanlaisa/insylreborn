<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timeline';

    protected $fillable = [
        'id_pengaduan', 'id_status'
    ];

//    public function pengaduan()
//    {
//        return $this->belongsTo(Pengaduan::class,'id_pengaduan','id');
//    }
//
//    public function status()
//    {
//        return $this->belongsTo(StatusPengaduan::class,'id_status','id');
//    }
}
