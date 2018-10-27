<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'id_admin', 'judul', 'isi', 'foto'
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'id_admin','id');
    }
}
