<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Http\Requests\StoreMainCategoryRequest;
use App\Http\Requests\UpdateMainCategoryRequest;
use App\Http\Resources\MainCategoryResource;
use App\Traits\ResponseTrait;

class MainCategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainCategories = MainCategory::all();
        return $this->successResponse('all amin-categories', 'main category', MainCategoryResource::collection($mainCategories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMainCategoryRequest $request)
    {
        $mainCategory =  MainCategory::create($request->validated());
        return $this->successResponse('main-category created successfully', 'main category', new MainCategoryResource($mainCategory), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MainCategory $mainCategory)
    {
        return $this->successResponse('main-category retrieved successfully', 'main category', new MainCategoryResource($mainCategory), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainCategoryRequest $request, MainCategory $mainCategory)
    {
        $mainCategory->update([
            'name' => $request->validated('name') ?? $mainCategory->name,
            'description' => $request->validated('description') ?? $mainCategory->description
        ]);
        return $this->successResponse('main-category updated successfully', 'main category', new MainCategoryResource($mainCategory), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainCategory $mainCategory)
    {
        $mainCategory->delete();
        return $this->deletedResponse('main-category deleted successfully');
    }
}
