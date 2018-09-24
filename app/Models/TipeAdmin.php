<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeAdmin extends Model
{
    protected $table = 'tipe_admin';

    protected $fillable = [
        'tipe'
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class,'id_tipe','id');
    }
}
