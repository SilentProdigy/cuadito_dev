<?php

namespace App\Console\Commands;

use App\Mail\Subscription\NearExpiration;
use App\Models\Subscription;
use App\Traits\SendEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckSubscriptionNearExpirationCommand extends Command
{
    use SendEmail;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:notify-near-expiration-subscription {days=3}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A system tool that will notify the clients with active subscriptions that are near on expiration.';

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
            $target_date = Carbon::today()->addDays(
                $this->argument('days')
            );

            Subscription::active()
            ->whereDate('expiration_date', $target_date)
            ->get()
            ->each(function($item) {    
                $subscriber = $item->client;

                $subscriber->notifications()->create([
                    'content' => "You're " . $item->subscription_type->name . " is about to expire!",
                    'url' => route('client.products.index'), 
                ]);
    
                $this->sendEmail($subscriber->email,new NearExpiration($item));
                
                Log::info('OPERATION: CHK_UPCOMING_EXPIRATION | SUB #ID:' . $item->id . '| SUBSCRIBER:' . $subscriber->id);
            });
        }
        catch(\Exception $e)
        {
            Log::error('Error: Operation Failed!, Message: ' . $e->getMessage());
        }

        return 0;
    }
}
