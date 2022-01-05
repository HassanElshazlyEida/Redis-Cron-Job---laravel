<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class FillRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill redis DB from Mysql DB';

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
        $customers=Customer::select("id","email")->get();

        foreach($customers as $customer){
            // Redis set
            Redis::set('email_'.$customer->email,$customer->id);
            // Cache set
            
            // Cache::put('email_'.$customer->email,$customer->id);
        }
        return 0;
    }
}
