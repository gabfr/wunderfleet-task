<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\Customers\StoreRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Creates the customer and dispatches the event to process its payment data
     * @param StoreRequest $request
     * @return CustomerResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['id'] = md5(uniqid());

        return new CustomerResource(
            Customer::create($data)
        );
    }

    /**
     * Returns the specified customer in the route
     * @param Customer $customer
     * @return CustomerResource
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }
}
