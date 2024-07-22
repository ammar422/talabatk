<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Http\Resources\VendorResource;
use App\Traits\ImageTrait;
use App\Traits\ResponseTrait;

class VendorController extends Controller
{
    use ResponseTrait, ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::paginate(5);
        return $this->successResponse('all vendors retrieved successfully', 'vendors', $vendors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        $image = null;
        if ($request->has('image')) {
            $image = $this->saveImage('vendor-images', $request->image);
        }
        $validatedData = $request->validated();
        $validatedData['image'] = $image;
        $vendor = Vendor::create($validatedData);
        return $this->successResponse('vendor created successfully', 'vendor', new VendorResource($vendor));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return $this->successResponse('the vendor retrieved successfully', 'vendor', new VendorResource($vendor));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $vendor->update($request->validated());
        return $this->successResponse('vendor updated successfully', 'vendor', $vendor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return $this->deletedResponse('vendor deleted successfully');
    }
}
