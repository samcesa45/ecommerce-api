<?php

namespace App\Http\Controllers\API;

use App\Models\ProductAttribute;
use App\Http\Controllers\AppBaseController;
use App\Events\ProductAttributeCreated;
use App\Events\ProductAttributeUpdated;
use App\Events\ProductAttributeDeleted;
use App\Http\Requests\API\StoreProductAttributeAPIRequest;
use App\Http\Requests\API\UpdateProductAttributeAPIRequest;
use Illuminate\Http\Request;
use Response;

class ProductAttributeAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductAttribute::query();

        if($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        
        if($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $productAttributes = $query->get();

        return $this->sendResponse($productAttributes->toArray(),'ProductAttributes retrieved successfully');
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
    public function store(StoreProductAttributeAPIRequest $request)
    {
        $input = $request->all();
        $productAttribute = ProductAttribute::create($input);

        if(empty($productAttribute)) {
            return $this->sendError('ProductAttribute not found');
        }

        ProductAttributeCreated::dispatch($productAttribute);

        return $this->sendResponse($productAttribute->toArray(),'ProductAttribute saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $productAttribute = ProductAttribute::find($id);

       if(empty($productAttribute)) {
        return $this->sendError('ProductAttribute not found');
       }

       return $this->sendResponse($productAttribute->toArray(),'PorductAttrinbute retrieved successfully');
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
    public function update(UpdateProductAttributeAPIRequest $request,  $id)
    {
        $productAttribute = ProductAttribute::find($id);

        if(empty($productAttribute)) {
            return $this->sendError('ProductAttribute not found');
        }

        $productAttribute->fill($request->all());
        $productAttribute->save();

        ProductAttributeUpdated::dispatch($productAttribute);

        return $this->sendResponse($productAttribute->toArray(),'ProductAttribute saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productAttribute = ProductAttribute::find($id);

        if(empty($productAttribute)) {
            return $this->sendError('ProductAttribute not found');
        }

        $productAttribute->delete();

        ProductAttributeDeleted::dispatch($productAttribute);

        return $this->sendSuccess('ProductAttribute deleted successfully');
    }
}
