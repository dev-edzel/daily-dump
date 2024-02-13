<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerServices;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(StoreCustomerRequest $request, CustomerServices $customerDetails)
    {
        $customer = $customerDetails->store($request->validated());

        return new CustomerResource($customer);
    }
}
