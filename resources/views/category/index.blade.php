@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-hover user-roles">
        <thead class="thead-dark">
            <tr>
                <th>Category</th>
                <th>No. of videos</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($categories as $category)
        		<tr>
        			<td>{{ strtoupper($category->categories) }}</td>
        			<td>{{ count($category->medias) }}</td>
        			<td>
        				<div class="form-group d-inline-flex">
	        				<a class="btn btn-info text-white mr-2" href="#" data-toggle="modal" data-target="#modal-{{ $category->cat_slug }}">Edit</a>
	        				<form action="{{ route('category.destroy', ['category'=>$category->id]) }}" method="post">
	        					@csrf
	        					@method('DELETE')
	        					<button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ ucfirst($category->categories) }} ?')">Delete</button>
	        				</form>
        				</div>
        			</td>
        		</tr>
        	@endforeach
		@include('layouts.errors')
		@if (session('delete_error'))
			<div class="alert alert-danger alert-posts">
				{{ session('delete_error') }}
			</div>
		@endif	
        </tbody>
    </table>
</div>

<!-- Modal Add -->
@foreach ($categories as $category)
	<div class="modal fade bd-example-modal-lg" id="modal-{{ $category->cat_slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLongTitle">{{ 'Edit ' . strtoupper($category->categories) }}</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	            	<form action="{{ route('category.update', ['category'=>$category->id]) }}" method="post">
	            		@csrf
	            		@method('PUT')
	            		<div class="form-group">
	            			<input type="text" name="categories" value="{{ $category->categories }}" class="form-control" required>
	            		</div>
	            		<div class="form-group">
	            			<button class="btn btn-info">Save</button>
	            		</div>
	            	</form>
	            </div>
	        </div>
	    </div>
	</div>
@endforeach


@endsection
