<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiJawaban extends Model
{
    protected $table = 'opsi_jawaban';

    protected $fillable = [
        'nama', 'id_tipe_jawaban'
    ];

    public function detailJawaban()
    {
        return $this->hasMany(DetailJawaban::class,'id_jawaban_survey','id');
    }

    public function tipejawaban()
    {
        return $this->belongsTo(TipeJawaban::class,'id_tipe_jawaban','id');
    }
}
