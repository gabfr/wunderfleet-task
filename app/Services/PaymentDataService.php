<?php

namespace App\Services;

use App\Customer;

class PaymentDataService
{
    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('services.payment-data.url')]);
    }

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
