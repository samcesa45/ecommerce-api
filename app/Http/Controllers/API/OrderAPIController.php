<?php

namespace App\Http\Controllers\API;
use App\Models\Order;
use App\Events\OrderCreated;
use App\Events\OrderUpdated;
use App\Events\OrderDeleted;
use App\Http\Request\API\StoreOrderAPIRequest;
use App\Http\Request\API\UpdateOrderAPIRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class OrderAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if($request->get('skip')) {
            $query->skip($request->get('skip'));
        }

        if($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $orders = $query->get();
        
        return $this->sendResponse($orders->toArray(),'Orders retrieved successfully');
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
    public function store(StoreOrderAPIRequest $request)
    {
       $input = $request->all();
       $order = Order::create($input);

       if(empty($order)) {
        return $this->sendError('Order not found');
       }

       OrderCreated::dispatch($order);

       return $this->sendResponse($order->toArray(),'Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        if(empty($order)) {
            return $this->sendError('Order not found');
        }

        return $this->sendResponse($order->toArray(),'Order retrieved successfully');
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
    public function update(UpdateOrderAPIRequest $request, $id)
    {
        $order = Order::find($id);

        if(empty($order)) {
            return $this->sendError('Order not found');
        }

        $order->fill($request->all());
        $order->save();

        OrderUpdated::dispatch($order);


        return $this->sendResponse($order->toArray(),'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if(empty($order)) {
            return $this->sendError('Order not found');
        }

        $order->delete();

        OrderDeleted::dispatch($order);

        return $this->sendSuccess('Order deleted successfully');
    }
}
