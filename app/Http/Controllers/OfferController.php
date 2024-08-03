<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Traits\ResponseTrait;

class OfferController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allOffers = Offer::with('product')->paginate(10);
        return $this->successResponse('all offers get successfully', 'all offers', $allOffers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {

        $offer = Offer::create($request->validated());
        return $this->successResponse('offer created successfully', 'offer', new OfferResource($offer->load('product')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return $this->successResponse('offer get successfully', 'offer', new OfferResource($offer->load('product')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer->update($request->validated());
        return $this->successResponse('the offer updated successfully', 'offer', new OfferResource($offer->load('product')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return $this->deletedResponse('offer deleted succesffully');
    }
}
