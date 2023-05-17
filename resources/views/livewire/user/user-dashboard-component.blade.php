<main>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md-4 text-center">
                                <img src="https://img.freepik.com/free-psd/google-icon-isolated-3d-render-illustration_47987-9777.jpg" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="max-width: 256px;">
							</div>
							<div class="col-md-8">
								<h1 class="mb-0 name">{{Auth::user()->name}}</h1>
								<div class="mb-2 email">{{Auth::user()->email}}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row m-2 p-3">
			<div class="col m-2 p-3">
				<div class="container wow fadeIn animated">
					<h3 class="section-title mb-20"><span>My</span> Books</h3>
					@php
					$books = json_decode(Auth::user()->books, true);
					@endphp

					<div class="carausel-6-columns-cover position-relative">
						<div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
						<div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
							@foreach($books as $book)
							<div class="card-1">
								<figure class=" img-hover-scale overflow-hidden">
									<img class="animated slider-1-1" src="{{asset('material/imges')}}/{{$book['image']}}" alt="{{$book['name']}}">
								</figure>
								<h5>
									<h5 class="card-title"><a href="{{route('product.details',['slug'=>$book['slug']])}}">{{$book['name']}}</a></h5>
								</h5>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
</main>

<style>
    .name{
        font-size: 36px;
    }
    
     .email {
        font-size: 24px;
    }
</style>