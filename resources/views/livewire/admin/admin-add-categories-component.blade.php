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
                    <span></span> Add New Category
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-6">
                                    Add New Category
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.categories')}}" class="btn btn-success float-end">All Categories</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif    
                                <form wire:submit.prevent="storeCategory">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter category name" wire:model="name" wire:keyup="generateSlug" />
                                        @error('name')
                                            <p class="text-denger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" placeholder="Enter category slug" wire:model="slug"/>
                                        @error('slug')
                                            <p class="text-denger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" wire:model="image" />
                                        @error('image')
                                            <p class="text-denger">{{$message}}</p>
                                        @enderror
                                        @if($image)
                                            <img src="{{$image->temporaryUrl()}}" widtth="120" />
                                        @endif
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="is_popular" class="form-label">Popular</label>
                                        <select class="form-control" name="is_popular" wire:model="is_popular">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        @error('is_popular')
                                            <p class="text-denger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div
        </section>
    </main>
</div>
