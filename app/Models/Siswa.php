<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'id_kelas', 'id_user', 'nit', 'nama', 'kontak', 'alamat', 'tanggal_lahir'
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
}
