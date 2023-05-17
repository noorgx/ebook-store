<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hiddden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> All Slides
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        All Slides
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('admina.home.slide.add')}}" class="btn btn-success float-end">Add New Slide</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif 
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>TopTitle</th>
                                            <th>Title</th>
                                            <th>SubTitle</th>
                                            <th>Offer</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($slides as $slide)
                                            <tr>
                                                <th>{{$i++}}</th>
                                                <th><img src="{{asset('material/sliders')}}/{{$slide->image}}" width="80" /></th>
                                                <th>{{$slide->top_title}}</th>
                                                <th>{{$slide->title}}</th>
                                                <th>{{$slide->sub_title}}</th>
                                                <th>{{$slide->offer}}</th>
                                                <th>{{$slide->link}}</th>
                                                <th>{{$slide->status == 1 ? 'Active':'Inactive'}}</th>
                                                <td>
                                                    <a href="{{route('admina.home.slide.edit',['slide_id'=>$slide->id])}}" class="text-info">Edit</a>
                                                    <a href="#" class="text-danger" wire:click.prevent="deleteSlide({{$slide->id}})" style="margin-left:20px;">Delete</a>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{$slides->links()}} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div
        </section>
    </main>
</div>

{{-- <div class="modal" id="deleteConfirmation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body pb-30 pt-30">
				<div class="row">
					<div class="col-md-12 text-center">
						<h4 class="pb-3">Do you want to delete this record?</h4>
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
						<button type="button" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id)
        {
            @this.set('slide_id',id);
            $('#deleteConfirmation').modal('show');
        }
    </script>
@endpush --}}