<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeJawaban extends Model
{
    protected $table = 'tipe_jawaban';

    protected $fillable = [
        'nama'
    ];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanSurvey::class,'id_tipe_jawaban','id');
    }
}
