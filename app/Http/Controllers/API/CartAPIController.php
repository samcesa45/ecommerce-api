<?php

namespace App\Http\Controllers\API;
use App\Events\CartCreated;
use App\Events\CartUpdated;
use App\Events\CartDeleted;
use App\Models\Cart;
use App\Http\Request\API\StoreCartAPIRequest;
use App\Http\Request\API\UpdateCartAPIRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class CartAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cart::query();

        if($request->get('skip')) {
            $query->skip($request->get('skip'));
        }

        if($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $carts = $query->get();
        return $this->sendResponse($carts->toArray(), 'Carts retreived successfully');
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
    public function store(StoreCartAPIRequest $request)
    {
        //
        $input = $request->all();
        $cart = Cart::create($input);
        
        if(empty($input)) {
            return $this->sendError('Cart not found');
        }
        
        CartCreated::dispatch($cart);

        return $this->sendResponse($cart->toArray(),'Cart saved successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $cart = Cart::find($id);

        if(empty($cart)) {
            return $this->sendError('Cart not found');
        }

        return $this->sendResponse($cart->toArray(),'Cart retrieved successfully');
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
    public function update(UpdateCartAPIRequest $request, string $id)
    {
        //
        $cart = Cart::find($id);

        if(empty($cart)) {
            return $this->sendError('Cart not found');
        }

        $cart->fill($request->all());
        $cart->save();

        CartUpdated::dispatch($cart);

        return $this->sendResponse($cart->toArray(), 'Cart updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $cart = Cart::find($id);

        if($empty($cart)) {
            return $this->sendError('Cart not found');
        }

        $cart->delete();

        CartDeleted::dispatch($cart);

        return $this->sendSuccess('Cart deleted successfully');

    }
}
