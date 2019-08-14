<?php

namespace App\Services;

use App\Customer;
use GuzzleHttp\Client;

class PaymentDataService
{
    /**
     * PaymentDataService constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('services.payment-data.url')]);
    }

    /**
     * Creates the customer payment data on the wunderfleet service API
     * @param Customer $customer
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function process(Customer $customer)
    {
        $response = $this->client->request('POST', '/default/wunderfleet-recruiting-backend-dev-save-payment-data', [
            'json' => [
                'customerId' => $customer->id,
                'owner' => $customer->accountOwner,
                'iban' => $customer->iban,
            ]
        ]);
        $responseBody = (string)$response->getBody();
        $responseJson = json_decode($responseBody, true);
        if ($responseJson === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error when decoding the json that came back from the payment data api: ' . json_last_error_msg());
        }

        $customer->remotePaymentDataId = $responseJson['paymentDataId'];
        $customer->save();
    }
}
