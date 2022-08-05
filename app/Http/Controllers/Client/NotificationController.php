<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth('client')->user()
                        ->notifications()
                        ->orderBy('id', 'desc')
                        ->paginate();

        return view('client.notifications.index')->with(compact('notifications'));
    }

    public function show(Notification $notification)
    {
        $notification->update(['opened' => true]);
        return redirect($notification->url);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        try 
        {
            // TODO: Additional business logic here ...
            $notification->delete();
            return redirect(route('client.notifications.index'))->with('success', 'Notification was successfully removed.');  
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
