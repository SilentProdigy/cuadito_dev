<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SubscriptionsResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:reset-active-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A system tool for resetting the active subscriptions count fields';

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
            Subscription::active()->get()
            ->each(function($item) {
                $item->resetCounterFields();
                Log::info('OPERATION:RESET_COUNT_FIELDS, STATUS:OK, SUBSCRIPTION_ID:' . $item->id);
            });
        }
        catch(\Exception $e)
        {
            Log::error('OPERATION:RESET_COUNT_FIELDS, STATUS:FAILED, ERROR:' . $e->getMessage());
        }

        return 0;
    }
}
