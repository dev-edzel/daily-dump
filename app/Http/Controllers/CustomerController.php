<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerServices;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Customer::class);
    }

    public function store(StoreCustomerRequest $request, CustomerServices $customerDetails)
    {
        $customer = $customerDetails->store($request->validated());

        return new CustomerResource($customer);
    }

    public function index()
    {
        // $this->authorize('viewAny', Customer::class);

        return new CustomerCollection(Customer::all());
    }
}
