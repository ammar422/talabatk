<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Traits\ResponseTrait;

class CartController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', auth('api')->id())->get();
        $tottalPrice = $cart->sum(fn ($cartItem) => $cartItem->product->price * $cartItem->quantity);
        return response()->json([
            'status' => true,
            'message' => 'cart retrieved successfully',
            'cart' => CartResource::collection($cart),
            'total_price' => $tottalPrice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $cart = Cart::create($data);
        return $this->successResponse('product addedd to cart successfully ', 'cart', new CartResource($cart));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        if ($cart->user_id == auth('api')->id())
            return $this->successResponse('cart retrieved successfully', 'cart', new CartResource($cart));
        return $this->faildResponse('Unauthorized', 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id())
            return $this->faildResponse('Unauthorized', 401);
        $cart->update($request->validated());
        return $this->successResponse('the cart element updated successfully', 'cart', new CartResource($cart));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id())
            return $this->faildResponse('Unauthorized', 401);
        $cart->delete();
        return $this->deletedResponse('cart element deleted successfully');
    }

    public function deleteAll()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        $carts->each(fn ($item) => $item->delete());

        return $this->deletedResponse('all element in the cart deleted successfully');
    }
}
