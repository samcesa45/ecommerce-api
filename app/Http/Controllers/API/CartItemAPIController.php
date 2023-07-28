<?php

namespace App\Http\Controllers\API;

use App\Events\CartItemCreated;
use App\Events\CartItemUpdated;
use App\Events\CartItemDeleted;
use App\Models\CartItem;
use App\Http\Request\API\StoreCartItemAPIRequest;
use App\Http\Request\API\UpdateCartItemAPIRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class CartItemAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = CartItem::query();

        if($request->get('skip')) {
            $query->skip($request->get('skip'));
        }

        if($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $cartItems = $query->get();
        return $this->sendResponse($cartItems->toArray(),'CartItems retrieved successfully');
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
    public function store(StoreCartItemAPIRequest $request)
    {
        $input = $request->all();
        $cartItem = CartItem::create($input);

        if(empty($cartItem)) {
            return $this->sendError('CartItem not found');
        }

        CartItemCreated::dispatch($cartItem);

        return $this->sendResponse($cartItem->toArray,'CartItem saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $cartItem = CartItem::find($id);

       if(empty($cartItem)) {
        return $this->sendError('CartItem not found');
       }

       return $this->sendResponse($cartItem->toArray(), 'CartItem retrieved successfully');
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
    public function update(UpdateCartItemAPIRequest $request, $id)
    {
        $cartItem = CartItem::find($id);

        if(empty($cartItem)) {
            return $this->sendError('CartItem not found');
        }

        $cartItem->fill($request->all());
        $cartItem->save();

        CartItemUpdated::dispatch($cartItem);

        return $this->sendResponse($cartItem->toArray(),'CartItem saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartItem = CartItem::find($id);

        if(empty($cartItem)) {
            return $this->sendError('CartItem not found');
        }

        $cartItem->delete();

        CartItemDeleted::dispatch($cartItem);

        return $this->sendSuccess('CartItem deleted successfully');

    }
}
