<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::updateOrCreate(
            ['user_id' => $request->user_id, 'stock_id' => $request->stock_id],
            ['quantity' => $request->quantity]
        );

        return response()->json(['message' => 'Item added to cart', 'cartItem' => $cartItem]);
    }



    public function deleteCart($id)
    {
        $stock = Cart::findOrFail($id);
        $stock->delete();

        return response()->json(['message' => 'Stock entry deleted successfully'], 200);
    }



    public function getAllCarts($id)
    {
        $items = DB::table('carts')
            ->join('stocks','carts.stock_id','=','stocks.id')
            ->join('products', 'stocks.product_id', '=', 'products.id')
            ->join('users', 'stocks.seller_id', '=', 'users.id')
            ->select('carts.id','stocks.id as stock_id','products.image_path as image_path', 'products.name as product_name', 'users.name as seller_name', 'stocks.price', 'carts.quantity')
            ->where('carts.user_id', $id)
            ->where('carts.checkout', 'No')

            ->get();
    
            $items->each(function($items) {
                $items->image_url = url('images/' . basename($items->image_path));
            });
            
    
        return response()->json($items);
    }

    public function checkout(Request $request)
    {
        $userId = $request->input('user_id');

        $cartItems = Cart::where('user_id', $userId)
            ->where('checkout', 'No')
            ->get();

        DB::transaction(function () use ($cartItems) {
            foreach ($cartItems as $cartItem) {
                $stock = Stock::find($cartItem->stock_id);
                if ($stock->amount < $cartItem->quantity) {
                    throw new \Exception("Not enough stock for product {$stock->product_id}");
                }
                $stock->amount -= $cartItem->quantity;
                $stock->save();

                $cartItem->checkout = 'Yes';
                $cartItem->save();
            }
        });

        return response()->json(['message' => 'Checkout completed successfully']);
    }
}




