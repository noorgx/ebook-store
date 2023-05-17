<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;
class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            return redirect()->route('login');
        }
        $cartItem = Cart::instance('cart')->content()->where('id', $product_id)->first();
        $books=Auth::user()->books;
        $boo= json_decode($books, true); // Convert the JSON string to an array
        
        // dd(collect($books)->contains($cartItem));
        if(collect($boo)->contains('product_id', $product_id)){
            session()->flash('success_message', 'Book already Bought');
            return redirect()->route('home.index');
        }else{
            if (!$cartItem) {
                // dd($cartItem);
                Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
                
                session()->flash('success_message', 'Book added in Cart');
            } else {
                session()->flash('success_message', 'Book already in Cart');
            }
        }
        
        return redirect()->route('shop.cart');
    }
    public function render()
    {
        $slides = HomeSlider::where('status',1)->get();
        $lproducts = Product::orderby('created_at','DESC')->get()->take(8);
        $fproducts = Product::where('featured',1)->inRandomOrder()->get()->take(8);
        $pcategories = Category::where('is_popular',1)->inRandomOrder()->get()->take(8);

        // if(Auth::check())
        // {
        //     Cart::instance('cart')->restore(Auth::user()->id);
        // }
        return view('livewire.home-component',['slides'=>$slides,'lproducts'=>$lproducts,'fproducts'=>$fproducts,'pcategories'=>$pcategories]);
    }
}
