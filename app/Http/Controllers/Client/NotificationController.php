<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth('client')->user()->notifications()
                        ->whereNull('type')
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
        DB::beginTransaction();
        try 
        {
            // TODO: Additional business logic here ...
            $notification->delete();
            DB::commit();
            return redirect(route('client.notifications.index'))->with('success', 'Notification was successfully removed.');  
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            Log::error("ACTION: NOTIFICATION_DELETE, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }
}
