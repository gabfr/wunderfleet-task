<?php

namespace Tests\Feature;

use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersRegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCustomerRegistrationWithValidData()
    {
        $customer = factory(Customer::class)->make();

        $response = $this->postJson('/api/customers', $customer->toArray());

        $response->assertStatus(201);
    }
}
