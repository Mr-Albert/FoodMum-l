<?php

namespace App\user_models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $incrementing  = true;

    protected $fillable = [
        'name','description', 'type',
    ];
    public function roles()
    {
        return $this->belongsToMany('App\user_models\Role','role_permission','permission_id', 'role_id');
    }
}
