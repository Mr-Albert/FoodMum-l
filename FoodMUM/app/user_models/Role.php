<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    protected $incrementing  = true;
    protected $fillable = [
        'name','description'
    ];
    //
    public function users()
    {
        return $this->belongsToMany('App\user_model\User','role_user','role_id', 'user_id');
    }
    public function Permissions()
    {
        return $this->belongsToMany('App\user_model\Permission','role_permission','role_id', 'permission_id');
    }
}
