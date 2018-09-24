<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $fillable = [
        'id_user', 'id_tipe', 'id_layanan', 'nip', 'nama'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function tipe()
    {
        return $this->belongsTo(TipeAdmin::class,'id_tipe','id');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananPengaduan::class,'id_layanan','id');
    }
}
