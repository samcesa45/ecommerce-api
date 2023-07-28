<?php

namespace App\Http\Controllers\API;

use App\Models\Product;

use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use App\Events\ProductDeleted;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\StoreProductAPIRequest;
use App\Http\Requests\API\UpdateProductAPIRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Traits\ApiResponder;
use Response;

class ProductAPIController extends AppBaseController
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $query = Product::query();

        if($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $products = $this->showAll($query->get());
        
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully');
        
    }

    public function getNewestProduct() 
    {
        $newestProducts = Product::orderBy('created_at','desc')->take(3)->get();
        return $this->sendResponse($newestProducts->toArray(),'Newest products retrieved successfully');
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
    public function store(StoreProductAPIRequest $request)
    {
        //
        // dd(auth()->user());
        // dd('products');
        $input = $request->all();

        if($request->hasFile('image_url')) {
             $file =  $request->file('image_url');
             $fileName = $file->hashName();
             $extension = $file->extension();
             $input['image_url'] = $file->store('uploads/','public');
        }

        $products = Product::create($input);
        ProductCreated::dispatch($products);
        return $this->sendResponse($products->toArray(), 'Products saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(empty($product)) {
            return $this->sendError('Product not found');
        }

        return $this->sendResponse($product->toArray(), 'Product retrieved successfully');
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
    public function update(UpdateProductAPIRequest $request,$id)
    {
        $product = Product::find($id);
        $input = $request->all();

        if(empty($product)) {
            return $this->sendError('Product not found');
        }

        if($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $fileName = $file->hashName();
            $extension = $file->extension();
            $input['image_url'] = $file->store('uploads/', 'public');
        }

        $product->fill($input);
        $product->save();

        ProductUpdated:dispatch($product);
        return $this->sendResponse($product->toArray(), 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(empty($product)) {
            return $this->sendError('Product not found');
        }

        $product->delete();
        ProductDeleted::dispatch($product);
        return $this->sendSuccess('Product deleted successfully');
    }
}
