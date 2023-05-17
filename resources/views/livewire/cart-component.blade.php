<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> <a style="color:gray;" href="{{route('shop')}}" rel="nofollow">Shop</a>
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                        @if(Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success | {{Session::get('success_message')}}</strong>
                            </div>
                        @endif
                                    @if(Cart::count() > 0)
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach(Cart::content() as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ asset('material/imges')}}/{{$item->model->image}}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="product-details.html">{{$item->model->name}}</a></h5>
                                        </td>
                                        <td class="price" data-title="Price"><span>${{$item->model->regular_price}} </span></td>
                                        <td class="action" data-title="Remove"><a href="#" class="text-muted" onclick="location.reload()" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                   
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted" onclick="location.reload()" wire:click.prevent="clearAll()"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                                <p>No item in cart </p>
                            @endif
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn  mr-10 mb-sm-15" onclick="location.reload()"><i class="fi-rs-shuffle mr-10"></i>Update Cart</a>
                            <a class="btn " href="{{route('shop')}}"><i class="fi-rs-shopping-bag mr-10" wire:></i>Continue Shopping</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{Cart::subtotal()}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Tax</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{Cart::tax()}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{Cart::total()}}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{route('payment')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
