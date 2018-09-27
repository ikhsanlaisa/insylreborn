<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'id_siswa', 'id_jenis', 'isi', 'foto', 'hasil'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa','id');
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class,'id_pengaduan','id');
    }

    public function status()
    {
        return $this->belongsToMany(StatusPengaduan::class,'timeline','id_pengaduan','id_status');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananPengaduan::class,'id_jenis','id');
    }
}
