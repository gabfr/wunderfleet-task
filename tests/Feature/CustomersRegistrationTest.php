<?php

namespace Tests\Feature;

use App\Customer;
use App\Events\CustomerWasCreated;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the basic case of creation only.
     *
     * @return void
     */
    public function testCustomerRegistrationWithValidData()
    {
        Event::fake();
        $customer = factory(Customer::class)->make();

        $response = $this->postJson('/api/customers', $customer->toArray());

        $response->assertStatus(201);
        $responseBody = $response->getContent();
        $responseJson = json_decode($responseBody, true);

        $this->assertArrayHasKey('data', $responseJson);
        $this->assertArrayNotHasKey('paymentDataId', $responseJson['data']);
        $this->assertArrayHasKey('id', $responseJson['data']);
        Event::assertDispatched(CustomerWasCreated::class);
    }

    /**
     * Test the creation and check if the paymentDataId will be populated after api call
     */
    public function testCustomerShowRequest()
    {
        $customer = Event::fakeFor(function () {
            $customer = factory(Customer::class)->create();

            Event::assertDispatched(CustomerWasCreated::class);

            return $customer;
        });

        $response = $this->getJson("/api/customers/{$customer->id}");
        $response->assertStatus(200);
        $responseBody = $response->getContent();
        $responseJson = json_decode($responseBody, true);

        $this->assertArrayHasKey('data', $responseJson);
        $this->assertArrayNotHasKey('paymentDataId', $responseJson['data']);
        $this->assertArrayHasKey('id', $responseJson['data']);
    }
}
