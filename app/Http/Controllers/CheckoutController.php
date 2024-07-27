<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    use ResponseTrait;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $carts = auth()->user()->cart;
        if ($carts->isEmpty())
            return $this->faildResponse('This user does not have a shopping cart', 400);


        $totalPrice = $carts->sum(fn ($item) => $item->product->price * $item->quantity);

        DB::beginTransaction();
        try {

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'status' => 'pending'
            ]);

            foreach ($carts as $cart) {
                if ($cart->quantity > $cart->product->stock)
                    return $this->faildResponse('The product : ' . $cart->product->name .  ' stock does not allow, please modify the quantity , max allowed quantity : ' . $cart->product->stock, 400);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price * $cart->quantity
                ]);
                $cart->delete();
                $cart->product->decrement('stock', $cart->quantity);
            }
            DB::commit();
            return $this->successResponse('Your order has been received successfully', 'order', new OrderResource($order));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->faildResponse('Checkout failed', 400);
        }
    }
}
