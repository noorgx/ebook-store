<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addItem(Request $request, $productId)
    {
        $user = Auth::user();
        $cart = $user->cart;

        $item = $cart->items()->where('product_id', $productId)->first();

        
        $cart->items()->create([
            'product_id' => $productId,
        ]);
        

        return redirect()->route('cart.show')->with('success', 'Item has been added to the cart.');
    }

    public function removeItem(Request $request, $productId)
    {
        $user = Auth::user();
        $cart = $user->cart;

        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            
            $item->delete();
            
        }

        return redirect()->route('cart.show')->with('success', 'Item has been removed from the cart.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        foreach ($request->input('item_id') as $itemId) {
            $item = $cart->items()->where('id', $itemId)->first();
            if ($item) {
                $item->delete();
            }
        }
        return redirect()->route('cart.show')->with('success', 'Cart has been updated.');
    }

    public function show()
    {
        $cartItems = Cart::getCartItems();

        return view('cart.show', compact('cartItems'));
    }
}
