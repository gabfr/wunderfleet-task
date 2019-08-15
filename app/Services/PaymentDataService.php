<?php

namespace App\Services;

use App\Customer;
use GuzzleHttp\Client;

class PaymentDataService extends BaseService
{
    /**
     * The base URI of this service
     * @return string
     */
    public function baseUri(): string
    {
        return config('services.payment-data.url');
    }

    /**
     * PaymentDataService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Creates the customer payment data on the wunderfleet service API
     * @param Customer $customer
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function process(Customer $customer)
    {
        $response = $this->request('POST', '/default/wunderfleet-recruiting-backend-dev-save-payment-data', [
            'json' => [
                'customerId' => $customer->id,
                'owner' => $customer->accountOwner,
                'iban' => $customer->iban,
            ]
        ]);
        $responseBody = (string) $response->getBody();
        $responseJson = json_decode($responseBody, true);

        if ($responseJson === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error when decoding the json that came back from the payment data api: ' . json_last_error_msg());
        }

        return $responseJson;
    }
}
