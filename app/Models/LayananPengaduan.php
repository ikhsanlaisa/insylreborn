<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPengaduan extends Model
{
    protected $table = 'layanan_pengaduan';

    protected $fillable = [
        'jenis'
    ];

    public function admin()
    {
      return $this->hasOne(Admin::class,'id_layanan','id');
    }
}
