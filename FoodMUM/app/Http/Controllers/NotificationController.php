<?php

namespace App\Http\Controllers;
use App\Notifications\sysNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("notifications");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($noOfNotifications)
    {
        $notificationsTitles=array();
        $notificationsIds=array();
        $notifications=Auth::user()->notifications()->unread($noOfNotifications)->get(['title']);
        foreach($notifications as $notification)
        {
            $notificationsTitles[]=$notification['title'];
            $notificationsIds[]=$notification['pivot']['notification_id'];
        }
        //bugFix:to solve the ambig update col,the query must be anything->everything->toBase()->update(...);
        //Auth::user()->notifications()->where('read',false)->whereIn('notification_id', $notificationsIds)->toBase()->update(['read' => true,'notification_user.updated_at' => now()]);
        return (json_encode($notificationsTitles));

    }


    public function showAll(Request $request,$noOfNotifications= 0)
    {
        $notifications=Auth::user()->notifications()->paginate(5,['id','type','data','read_at','created_at'],'page',5)->toJSON();
        //issue:make them read
        return (( $notifications));
        // $sysNotification=['title'=>'1','data'=>'anydata'];
        // \App\User::find(1)->notify(new sysNotification($sysNotification));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
