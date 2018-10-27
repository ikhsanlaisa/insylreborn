<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class olahraga extends Model
{
    protected $table = 'olahraga';

    protected $fillable = [
        'cabang_olahraga', 'pj'
    ];

//    public function regis(){
//        return $this->hasMany('App\registrasi', 'olahraga_id');
//    }
//
//    public function jadwal(){
//        return $this->hasMany('App\jadwal', 'olahraga_id');
//    }
//
//    public function pertandingan(){
//        return $this->hasMany('App\pertandingan', 'cabor');
//    }
}
