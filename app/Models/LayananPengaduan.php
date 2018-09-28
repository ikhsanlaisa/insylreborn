<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPengaduan extends Model
{
    protected $table = 'layanan_pengaduan';

    protected $fillable = [
        'jenis'
    ];

    protected $dates = ['deleted_at'];

    public function admin()
    {
      return $this->hasOne(Admin::class,'id_layanan','id');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class,'id_jenis','id');
    }
}
