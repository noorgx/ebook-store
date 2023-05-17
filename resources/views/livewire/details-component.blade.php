<style>
	iframe
	{
		display: block;
		height: 100vh;
		border: none;
		background: transparent;
		max-width: 100%;
		/* Set the maximum width to be equal to the width of its container element */
	}

	.book_img
	{
		height: 500px;
	}

	.modal
	{
		display: none;
		position: default;
		z-index: 9999999;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0, 0, 0, 0.4);
	}

	.modal-content
	{
		background-color: rgba(0, 0, 0, 0);
		margin: 15% auto;
		padding: 20px;
		border: none;
		top: 0;
		width: 100%;
		height: 100%;
	}

	.close
	{
		color: gray;
		float: right;
		font-size: 35px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus
	{
		color: black;
		text-decoration: none;
		cursor: pointer;
	}
</style>
<div>
	<main class="main">
		<section class="mt-50 mb-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<div class="product-detail accordion-detail">
							<div class="row mb-50">
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="detail-gallery">
										<!-- MAIN SLIDES -->
										<div class="product-image-slider">
											<img class="book_img" src="{{ asset('material/imges')}}/{{$product->image}}" alt="product image">
										</div>
									</div>

								</div>
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="detail-info">
										<h2 class="title-detail m-5 ms-0">{{$product->name}}</h2>

										<div class="clearfix product-price-cover m-5 ms-0">
											<div class="product-price primary-color float-left">
												<ins><span class="text-brand">{{$product->regular_price}}</span></ins>
											</div>
										</div>
										<div class="bt-1 border-color-1 mt-15 mb-15"></div>
										<div class="short-desc mb-30 m-5 ms-0">
											<p>{{$product->short_description}}</p>
										</div>

										<div class="bt-1 border-color-1 mt-30 mb-30 m-5 ms-0"></div>
										<div class="detail-extralink m-5 ms-0">
											<div class="product-extra-link2">
                                            @auth
                                            @php
                                            $books = Auth::user()->books;
                                            $boo=json_decode($books, true)
                                            @endphp
                                                @if(collect($boo)->contains('product_id', $product->id))
                                                    <button class="button button-add-to-cart" id="open-modal-btn">Show Book</button>
												    <div id="modal" class="modal">
                                                        <div class="modal-content">
                                                            <span class="close">&times;</span>
                                                            <iframe class="" src="{{asset('lib/web/viewer.html')}}?file={{ asset('material/Full')}}/{{$product->PDF_full}}" ></iframe>
                                                        </div>
												    </div>
                                                @else
												    <button type="button" class="button button-add-to-cart" wire:click.prevent="store({{$product->id}},'{{$product->name}}','{{$product->regular_price}}','{{$product->image}}')">Add to cart</button>
                                                    <button class="button button-add-to-cart" style="background-color: gray; border:none;" id="open-modal-btn">Preview Demo</button>
                                                    <div id="modal" class="modal">
                                                        <div class="modal-content">
                                                            <span class="close">&times;</span>
                                                            <iframe class="" src="{{asset('lib/web/viewer.html')}}?file={{ asset('material/Demo')}}/{{$product->PDF_demo}}"></iframe>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <button type="button" class="button button-add-to-cart" wire:click.prevent="store({{$product->id}},'{{$product->name}}','{{$product->regular_price}}','{{$product->image}}')">Add to cart</button>
                                                <button class="button button-add-to-cart" style="background-color: gray; border:none;" id="open-modal-btn">Preview Demo</button>
												<div id="modal" class="modal">
													<div class="modal-content">
														<span class="close">&times;</span>
														<iframe class="" src="{{asset('lib/web/viewer.html')}}?file={{ asset('material/Demo')}}/{{$product->PDF_demo}}"></iframe>
													</div>
												</div>
                                            @endif   	
                                                
											</div>
										</div>

									</div>
									<!-- Detail Info -->
								</div>
							</div>
							<div class="tab-style3">
								<ul class="nav nav-tabs text-uppercase">
									<li class="nav-item">
										<a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
									</li>
								</ul>
								<div class="tab-content shop_info_tab entry-main-content">
									<div class="tab-pane fade show active" id="Description">
										<div class="">
											{{$product->description}}
										</div>
									</div>
								</div>

								<div class="row mt-60">
									<div class="col-12">
										<h3 class="section-title style-1 mb-30">Related Books</h3>
									</div>
									<div class="col-12">
										<div class="row related-products">
											@foreach($rproducts as $rproduct)
											<div class="col-lg-3 col-md-4 col-12 col-sm-6">
												<div class="product-cart-wrap small hover-up">
													<div class="product-img-action-wrap">
														<div class="product-img product-img-zoom">
															<a href="{{route('product.details',['slug'=>$rproduct->slug])}}" tabindex="0">
																<img class="default-img" src="{{ asset('material/imges')}}/{{$rproduct->image}}" alt="{{$rproduct->name}}">
																<img class="hover-img" src="{{ asset('material/imges')}}/{{$rproduct->image}}" alt="">
															</a>
														</div>
														<div class="product-action-1">
														</div>
														<div class="product-badges product-badges-position product-badges-mrg">
															<span class="new">New</span>
														</div>
													</div>
													<div class="product-content-wrap">
														<h2><a href="{{route('product.details',['slug'=>$rproduct->slug])}}" tabindex="0">{{$rproduct->name}}</a></h2>
														<div class="product-price">

														</div>
													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
		</section>
	</main>
</div>
<script>
	// Get the modal and button
	var modal = document.getElementById("modal");
	var btn = document.getElementById("open-modal-btn");

	// Get the close button
	var closeBtn = modal.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal
	btn.onclick = function()
	{
		modal.style.display = "block";
		modal.focus();

	}

	// When the user clicks the close button or anywhere outside the modal, close it
	closeBtn.onclick = function()
	{
		modal.style.display = "none";
	}

	window.onclick = function(event)
	{
		if (event.target == modal)
		{
			modal.style.display = "none";
		}
	}
</script>