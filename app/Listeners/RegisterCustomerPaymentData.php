<?php

namespace App\Listeners;

use App\Events\CustomerWasCreated;
use App\Services\PaymentDataService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterCustomerPaymentData implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * Process the payment data with the service api, and save the payment data id in the customer remotePaymentDataId.
     *
     * @param  CustomerWasCreated  $event
     * @throws \Exception
     * @return void
     */
    public function handle($event)
    {
        $customer = $event->customer;

        $service = new PaymentDataService();
        $service->process($customer);
    }
}
