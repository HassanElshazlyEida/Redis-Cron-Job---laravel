<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionExpireJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $customer;
    private $expire_date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer,$expire_date)
    {
        $this->customer=$customer;
        $this->expire_date=$expire_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sendMail('emails.subscribtion',$this->customer->email,'Please activate your subscribtion',$this->customer);
    }
}
