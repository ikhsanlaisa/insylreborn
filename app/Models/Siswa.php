<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'id_kelas', 'id_user', 'nit', 'nama', 'gender','kontak', 'alamat', 'tanggal_lahir'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class,'id_siswa','id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id_kelas','id');
    }

    public function jawabanSurvey()
    {
        return $this->hasMany(JawabanSurvey::class,'id_siswa','id');
    }

    public function configIndividu()
    {
        return $this->hasMany(ConfigSurveyIndividu::class,'id_siswa','id');
    }
}
