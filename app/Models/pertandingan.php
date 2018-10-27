<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pertandingan extends Model
{
    protected $table = 'pertandingan';
    protected $fillable = array('jadwal_id', 'keterangan', 'tim1', 'tim2', 'cabor', 'score', 'lokasi');

    public function jadwal(){
        return $this->belongsTo(jadwal::class, 'jadwal_id');
    }

    public function tim1_detail(){
        return $this->belongsTo(Kelas::class, 'tim1');
    }

    public function tim2_detail(){
        return $this->belongsTo(Kelas::class, 'tim2');
    }

    public function cabor_detail(){
        return $this->belongsTo(olahraga::class, 'cabor');
    }
}
