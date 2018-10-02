<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasInstruktur extends Model
{
    protected $table = 'kelas_instruktur';

    protected $fillable = [
        'id_kelas',
        'id_instruktur'
    ];
}
