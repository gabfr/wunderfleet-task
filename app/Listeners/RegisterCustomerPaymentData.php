<?php

namespace App\Listeners;

use App\Events\CustomerWasCreated;
use App\Services\PaymentDataService;
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
     * @param PaymentDataService $service
     * @throws \Exception
     * @return void
     */
    public function handle($event, PaymentDataService $service)
    {
        $customer = $event->customer;

        $responseJson = $service->process($customer);

        $customer->remotePaymentDataId = $responseJson['paymentDataId'];
        $customer->save();
    }
}
