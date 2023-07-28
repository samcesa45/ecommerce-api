<?php

namespace App\Http\Controllers\API;

use App\Events\CategoryCreated;
use App\Events\CategoryUpdated;
use App\Events\CategoryDeleted;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\API\StoreCategoryAPIRequest;
use App\Http\Requests\API\UpdateCategoryAPIRequest;
use App\Http\Controllers\AppBaseController;
use Response;

class CategoryAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
         $query = Category::query();

         if($request->get('skip')) {
            $query->skip($request->get('skip'));
         }

         if($request->get('limit')) {
            $query->limit($request->get('limit'));
         }
         $categories = $query->get();
         return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
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
    public function store(StoreCategoryAPIRequest $request)
    {
        $input = $request->all();
        $category= Category::create($input);

        if(empty($category)) {
            return $this->sendError('Category not found');
        }

        CategoryCreated::dispatch($category);

       return $this->sendResponse($category->toArray(), 'Category saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return $this->sendError('Category not found');
        }

        return $this->sendResponse($category->toArray(), 'Category retrieved successfully');
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
    public function update(UpdateCategoryAPIRequest $request,$id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return $this->sendError('Category not found');
        }

        $category->fill($request->all());
        $category->save();

        CategoryUpdated::dispatch($category);
        return $this->sendResponse($category->toArray(), 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if(empty($category)) {
            return $this->sendError('Category not found');
        }

        $category->delete();
        CategoryDeleted::dispatch($category);
        return $this->sendSuccess('Category deleted successfully');
    }
}
