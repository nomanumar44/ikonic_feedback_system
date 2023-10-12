<?php

namespace App\Console\Commands;

use App\Models\SaleTaxes\Customer;
use App\Models\SaleTaxes\DefaultNotification;
use App\Models\SaleTaxes\Income;
use App\Models\SaleTaxes\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromiseDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promiseDate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $deleteNoti = DefaultNotification::where('notification_type', 'defaulter_customer')->delete();

        $futureDate = Carbon::now()->addDays(5)->toDateString();

        $defaulterCustomers = Income::where('voucher_type', 'defaulter')->where('promis_date', '<', $futureDate)
            ->get();

        foreach ($defaulterCustomers as $defaulterCustomer) {
            $customer = Customer::where('id', $defaulterCustomer->customer_id)->first();

            $notif = new DefaultNotification();
            $notif->customer_id = $defaulterCustomer->customer_id;
            $notif->promise_date = $defaulterCustomer->promis_date;
            $notif->message = ucwords($customer->name) . ' Promise Date is';
            $notif->is_seen = 0;
            $notif->notification_type = 'defaulter_customer';
            $notif->company_id = $defaulterCustomer->company_id;
            $notif->sub_comp_id = $defaulterCustomer->sub_comp_id;
            $notif->save();

            \Log::info('Cron is working fine!');

        }


    }
}
