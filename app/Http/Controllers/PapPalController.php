<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Cart;
class PapPalController extends Controller
{
    
    public function goPayment(){

       return view('products.welcome');

    }
    public function payment()
    {
        if(Auth::check()){
            
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            return redirect()->route('login');
        }

        $cartItem = Cart::instance('cart')->content();
        
        if(count($cartItem)){
            $cartTotal=Cart::instance('cart')->total();
            $cartUserId=Auth::user()->id;
            $data = [];
            $items = [];
            
            foreach($cartItem as $item){
                $items[] = [
                        'id' => $item->id,
                        'name'=>$item->name,
                        'price' => $item->price,
                        'desc'  => $item->name,
                        'qty' => $item->qty
                ];
            }

            $data['items'] = $items;
            
            $data['invoice_id'] = $cartUserId;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $cartTotal;
            
            $provider = new ExpressCheckout;
            
            $response = $provider->setExpressCheckout($data);
            
            $response = $provider->setExpressCheckout($data, true);
        


                return redirect($response['paypal_link']);
        }else{
            session()->flash('success_message','The Cart Is Empty');
            return redirect()->route('home.index');
        }
        
    }

    public function cancel()
    {
        session()->flash('success_message','The Process Has Been Cancel');
        return redirect()->route('home.index');
    }

    public function success(Request $request)
    {
        $bought = Cart::instance('cart')->content();
        $provider = new ExpressCheckout;
        
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            
            $books = json_decode(Auth::user()->books, true); // Convert the JSON string to an array
            foreach($bought as $book){
                $books[] = [
                    $product = Product::where('id',$book->id)->first(),
                    'product_id' => $book->id,
                    'name' => $book->name,
                    'image'=>$product->image,
                    'pdf_demo'=>$product->PDF_demo,
                    'pdf_full'=>$product->PDF_full,
                    'slug'=>$product->slug,
                    'price' => $book->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Auth::user()->update(['books' => $books]);
            
            Cart::instance('cart')->content();
            Cart::destroy();
                session()->flash('success_message','Book Has Been Added In Your Dashboard');
                return redirect()->route('home.index');
        }
        else{
            session()->flash('success_message','Please try again later.');
            return redirect()->route('home.index');
        }
    }
}