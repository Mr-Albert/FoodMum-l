<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificationsTitles=array();
        $notificationsIds=array();
        $notifications=Auth::user()->notifications()->unread(5)->get(['title']);
        foreach($notifications as $notification)
        {
            $notificationsTitles[]=$notification['title'];
            $notificationsIds[]=$notification['pivot']['notification_id'];
        }
        //bugFix:to solve the ambig update col,the query must be anything->everything->toBase()->update(...);
        //Auth::user()->notifications()->where('read',false)->whereIn('notification_id', $notificationsIds)->toBase()->update(['read' => true,'notification_user.updated_at' => now()]);
        return (json_encode($notificationsTitles));

        return view('home');
    }
}
