<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama','email', 'password', 'tgl_lahir', 'no_hp', 'alamat', 'foto', 'kelas_id', 'roles', 'provider', 'provider_id', 'jwt_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'jwt_token'
    ];


    public function Kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id','id');
    }

    public function getAvatarAttribute()
    {
        $hash = md5(strtolower(trim($this->email))) . '.jpeg' . '?s=106&d=mm&r=g';
        return "https://secure.gravatar.com/avatar/$hash";
    }


}
