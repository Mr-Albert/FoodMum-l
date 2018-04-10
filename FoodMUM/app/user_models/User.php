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
    public $incrementing  = true;

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
        //related table model, intermeddiate table,forgienkey of current table,forgienkey of the related table
        return $this->belongsToMany('App\user_models\Role','role_user','user_id', 'role_id');
    }
    public function notifications()
    {
        return $this->belongsToMany('App\user_models\Notification','notification_user','user_id', 'notification_id')->withPivot('read');
    }

}
