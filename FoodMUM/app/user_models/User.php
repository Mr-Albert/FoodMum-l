<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    protected $incrementing  = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','userName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','defaultPassword', 'remember_token',
    ];
    public function roles()
    {
        //rlated table model, intermeddiate table,forgienkey of current table,forgienkey of the related table
        return $this->belongsToMany('App\user_model\Role','role_user','user_id', 'role_id');
    }
}