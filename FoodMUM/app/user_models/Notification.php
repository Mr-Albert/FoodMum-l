<?php
namespace App\user_models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $incrementing  = true;

    protected $fillable = [
        'title','description', 'source'
    ];
    public function scopeCountUnread($query)
    {
        return $query->count()->wherePivot('read',false);
    }
    public function scopeUnread($query,$numberOfNotifications)
    {
        return $query->where('read',false)->orderBy('notifications.created_at', 'desc')->take($numberOfNotifications);
    }

    public function users()
    {
        return $this->belongsToMany('App\user_models\User','notification_user','notification_id', 'user_id')->withPivot('read');
    }
}
