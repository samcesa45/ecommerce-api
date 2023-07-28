<?php

namespace App\Http\Controllers\API;

use App\Events\CustomerCreated;
use App\Events\CustomerUpdated;
use App\Events\CustomerDeleted;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\API\StoreCustomerAPIRequest;
use App\Http\Requests\API\UpdateCustomerAPIRequest;
use App\Http\Controllers\AppBaseController;
use Response;

class CustomerAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
         $query = Customer::query();

         if($request->get('skip')) {
            $query->skip($request->get('skip'));
         }

         if($request->get('limit')) {
            $query->limit($request->get('limit'));
         }
         $customers = $query->get();
         return $this->sendResponse($customers->toArray(), 'Customers retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerAPIRequest $request)
    {
        $input = $request->all();
        $customer= Customer::create($input);

        if(empty($customer)) {
            return $this->sendError('Customer not found');
        }

        CustomerCreated::dispatch($customer);

       return $this->sendResponse($customer->toArray(), 'Customer saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if(empty($customer)) {
            return $this->sendError('Customer not found');
        }

        return $this->sendResponse($customer->toArray(), 'Customer retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerAPIRequest $request,$id)
    {
        $customer = Customer::find($id);

        if(empty($customer)) {
            return $this->sendError('Customer not found');
        }

        $customer->fill($request->all());
        $customer->save();

        CustomerUpdated::dispatch($customer);
        return $this->sendResponse($customer->toArray(), 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if(empty($customer)) {
            return $this->sendError('Customer not found');
        }

        $customer->delete();
        CustomerDeleted::dispatch($customer);
        return $this->sendSuccess('Customer deleted successfully');
    }
}
