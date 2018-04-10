<?php

namespace App\user_models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $incrementing  = true;
    protected $fillable = [
        'name','description'
    ];
    //
    public function users()
    {
        return $this->belongsToMany('App\user_models\User','role_user','role_id', 'user_id');
    }
    public function Permissions()
    {
        return $this->belongsToMany('App\user_models\Permission','role_permission','role_id', 'permission_id');
    }
}
