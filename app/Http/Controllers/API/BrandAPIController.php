<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Events\BrandCreated;
use App\Events\BrandUpdated;
use App\Events\BrandDeleted;
use App\Http\Requests\API\StoreBrandAPIRequest;
use App\Http\Requests\API\UpdateBrandAPIRequest;
use App\Http\Traits\ApiResponder;
use App\Models\Brand;
use Response;

class BrandAPIController extends AppBaseController
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Brand::query();

        if($request->get('skip')) {
            $query->skip($request->get('skip'));
        }

        if($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $brands = $this->showAll($query->get());


        return $this->sendResponse($brands->toArray(),'Brands retrieved successfully');
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
    public function store(StoreBrandAPIRequest $request)
    {
        $input = $request->all();
        $brand = Brand::create($input);

        if(empty($brand)) {
            return $this->sendError('Brand not found');
        }

        BrandCreated::dispatch($brand);

        return $this->sendResponse($brand->toArray(),'Brand saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $brand = Brand::find($id);

       if(empty($brand)) {
        return $this->sendError('Brand not found');
       }

       return $this->sendResponse($brand->toArray(), 'Brand Retrieved successfully');
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
    public function update(UpdateBrandAPIRequest $request,$id)
    {
        $brand = Brand::find($id);
        if(empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand->fill($request->all());
        $brand->save();

        BrandUpdated::dispatch($brand);

        return $this->sendResponse($brand->toArray(),'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if(empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand->delete();

        BrandDeleted::dispatch($brand);

        return $this->sendSuccess('Brand successfully deleted');
    }
}
