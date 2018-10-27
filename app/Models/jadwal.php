<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = array('tim1', 'tim2', 'lokasi', 'date_time', 'olahraga_id');

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'tim1');
    }

    public function kelas1(){
        return $this->belongsTo(Kelas::class, 'tim2');
    }

    public function cb_olahraga(){
        return $this->belongsTo(olahraga::class, 'olahraga_id');
    }

    public function pertandingan(){
        return $this->hasMany(pertandingan::class, 'jadwal_id');
    }
}
