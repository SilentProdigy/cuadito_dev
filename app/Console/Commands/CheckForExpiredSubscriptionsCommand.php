<?php

namespace App\Console\Commands;

use App\Mail\Subscription\SubscriptionExpired;
use App\Models\Subscription;
use App\Traits\SendEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class CheckForExpiredSubscriptionsCommand extends Command
{
    use SendEmail;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:deactive-expired-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A system tool for deactivating the expired subscriptions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try 
        {
            Subscription::active()
            ->whereDate('expiration_date', Carbon::today())
            ->get()
            ->each(function($item) {
                $item->update(['status' => Subscription::INACTIVE_STATUS]);
    
                $subscriber = $item->client;

                $subscriber->notifications()->create([
                    'content' => "You're " . $item->subscription_type->name . " subscription has expired!",
                    'url' => route('client.products.index'), 
                ]);
    
                $this->sendEmail($subscriber->email,new SubscriptionExpired());
                
                Log::info('SUB #ID:' . $item->id . ' SUBSCRIBER:' . $subscriber->id);
            });
        }
        catch(\Exception $e)
        {
            Log::error('Error: Operation Failed!, Message: ' . $e->getMessage());
        }
       
        return 0;
    }
}
