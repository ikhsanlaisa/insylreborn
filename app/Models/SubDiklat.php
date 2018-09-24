<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDiklat extends Model
{
    protected $table = 'sub_diklat';

    protected $fillable = [
        'diklat_id', 'kode', 'nama'
    ];
}
