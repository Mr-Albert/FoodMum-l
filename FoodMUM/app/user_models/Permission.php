<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    protected $incrementing  = true;

    protected $fillable = [
        'name','description', 'type',
    ];
    public function roles()
    {
        return $this->belongsToMany('App\user_model\Role','role_permission','permission_id', 'role_id');
    }
}
