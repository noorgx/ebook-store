<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{  
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    public $slug;
    public function store($product_id,$product_name,$product_price){
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            return redirect()->route('login');
        }
        $cart = Cart::content()->where('id',$product_id);
        if($cart->isEmpty())
        {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('shop.cart');
        }else{
            session()->flash('success_message','Item already in Cart');
            return redirect()->route('shop.cart');
        }
        
    }

    public function changePageSize($size){
        $this->pageSize = $size;
    }

    public function changeOrderBy($order){
        $this->orderBy = $order;
    }
    public function mount($slug){
        $this->slug = $slug;
    }

    public function render()
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            return view('auth.login_cart');
        }
        $category = Category::where('slug',$this->slug)->first();
        $category_id = $category->id;
        $category_name =$category->name;
        if($this->orderBy == 'Price: Low to High'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }else if ($this->orderBy == 'Price: High to Low'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }else if ($this->orderBy == 'Sort By Newness'){
            $products = Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);

        }else{
            $products = Product::where('category_id',$category_id)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        $nproducts = Product::orderby('created_at','DESC')->get()->take(3);

        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name,'nproducts' => $nproducts,]);
    }
}
