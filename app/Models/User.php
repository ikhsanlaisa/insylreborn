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
        'username', 'status', 'password','email', 'jwt_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'jwt_token'
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_user', 'id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class,'id_user','id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function isSuperAdmin(){
        return $this->admin && $this['admin']['tipe']->tipe == 'Super Admin';
    }

    public function getAvatarAttribute()
    {
        $hash = md5(strtolower(trim($this->email))) . '.jpeg' . '?s=106&d=mm&r=g';
        return "https://secure.gravatar.com/avatar/$hash";
    }


}
