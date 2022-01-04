<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Console\Command;
use App\Jobs\SendSubscriptionExpireJob;

class SubscriptionExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:SubscriptionExpiryChecker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check which subscribed user has expire';

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
        $expired_customers=Customer::where("subscribtion_end_date","<",now())->get();
        foreach($expired_customers as $customer){
            $expire_date=Carbon::createFromFormat("Y-m-d",$customer->subscribtion_end_date)
            ->toDateString();
            dispatch(new SendSubscriptionExpireJob($customer,$expire_date));
        }


        return 0;
    }
}
