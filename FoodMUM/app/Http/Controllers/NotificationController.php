<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use ParamQueryHelper;

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
    public function show(Request $request, $noOfNotifications=5)
    {
        $notifications = Auth::user()->unreadNotifications()->paginate($noOfNotifications, ['data']);
        $notificationsTitles=array();
        foreach ($notifications as $notification) {
            $notificationsTitles[] = $notification['data']['data'];
        }
        Auth::user()->unreadNotifications()->limit($noOfNotifications)->update(['read_at' => now()]);
       return (json_encode(array('notifications'=>$notificationsTitles,'total'=>$notifications->total())));

    }

    public function showAll(Request $request, $noOfNotifications = 0)
    {
        $filters = (ParamQueryHelper::get_filters($request));
        $query = Auth::user()->notifications();
        foreach ($filters['filter'] as $filter) {
            if (array_keys($filter)[0] == "data") {
                $query->where(array_keys($filter)[0], "like", "%:%" . $filter[array_keys($filter)[0]]['values'] . "%");
            } else if (array_keys($filter)[0] == "created_at" || array_keys($filter)[0] == "read_at") {
                // $query->whereBetween(array_keys($filter)[0],$filter[array_keys($filter)[0]]['values'])->orWhereNull(array_keys($filter)[0]);
                $callbackVar = array(array_keys($filter)[0], $filter[array_keys($filter)[0]]['values']);
                $query->where(function ($innerQuery) use ($callbackVar) {
                    return $innerQuery->whereBetween($callbackVar[0], $callbackVar[1])->orWhereNull($callbackVar[0]);
                });

            } else {
                $query->where(array_keys($filter)[0], "like", "%" . $filter[array_keys($filter)[0]]['values'] . "%");
            }

        }

        $notifications = 
        $query->paginate($filters['records_per_page'], ['id', 'type', 'data', 'read_at', 'created_at'], 'page', $filters['current_page']);
        /*issue:make them read*/
        foreach ($notifications as $notificationElem) {
            if (isset($notificationElem["data"]) && isset(($notificationElem["data"])["data"])) {
                $notificationElem["details"] = ($notificationElem["data"])["data"];
            }

            if (isset($notificationElem["data"]) && isset(($notificationElem["data"])["title"])) {$notificationElem["data"] = ($notificationElem["data"])["title"];
                preg_match("/.*\\\(.*)/", $notificationElem["type"], $output_array);
                $notificationElem["type"] = $output_array[1];}
        }

        return (($notifications));
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
