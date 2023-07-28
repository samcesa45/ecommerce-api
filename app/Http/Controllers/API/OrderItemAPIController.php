<?php

namespace App\Http\Controllers\API;

use App\Models\OrderItem;
use App\Events\OrderItemCreated;
use App\Events\OrderItemUpdated;
use App\Events\OrderItemDeleted;
use App\Http\Request\StoreOrderItemAPIRequest;
use App\Http\Request\UpdatedOrderItemAPIRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class OrderItemAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
       $query = OrderItem::query();

       if($request->get('skip')) {
        $query->skip($request->get('skip'));
       }

       if($request->get('limit')) {
        $query->limit($request->get('limit'));
       }

       $orderItems = $query->get();
       return $this->sendResponse($orderItems->toArray(),'OrderItems retrieved successfully');
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
    public function store(StoreOrderItemAPIRequest $request)
    {
        $input = $request->all();
        $orderItem = OrderItem::create($input);
        if(empty($orderItem)) {
            return $this->sendError('OrderItems not found');
        } 

        OrderItemCreadted::dispatch($orderItem);

        return $this->sendResponse($orderItem->toArray(),'OrderItems created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orderItem = OrderItem::find($id);

        if(empty($orderItem)) {
            return $this->sendError('OrderItem not found');
        }

        return $this->sendResponse($orderItem->toArray(),'OrderItem retrieved successfully');
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
    public function update(UpdatedOrderItemAPIRequest $request, string $id)
    {
        $orderItem = OrderItem::find($id);

        if(empty($orderItem)) {
            return $this->sendError('OrderItem not found');
        }

        $orderItem->fill($request->all());
        $orderItem->save();

        OrderItem::dispatch($orderItem);

        return $this->sendResponse($orderItem->toArray(),'OrderItem updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $orderItem = OrderItem::find($id);

       if(empty($orderItem)) {
        return $this->sendError('OrderItem not found');
       }

       $orderItem->delete();

       OrderItemDeleted::dispatch($orderItem);
       return $this->sendSuccess('OrderItem deleted successfully');
    }
}
