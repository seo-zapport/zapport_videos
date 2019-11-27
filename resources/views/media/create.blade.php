@extends('layouts.app')

@section('content')
<form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                    <div class="form-group">
                        <label for="media">Media</label>
                        <input type="file" name="file_name" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label for="meta">Meta</label>
                        <input type="text" name="meta" class="form-control" placeholder="Enter Meta here" required>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="form-group">
                    <a class="btn btn-info btn-block text-white" href="#" data-toggle="modal" data-target="#roleModal"><i class="fa fa-plus"></i> Add Category </a>
                </div>
                <div class="form-group">
                    <label for="category_id">Select Category</label>
                    <select name="category_id[]" id="category_id" class="form-control" multiple required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ strtoupper($category->categories) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div><br>

        <div class="card">
            <div class="card-header">Submit</div>
            <div class="card-body">
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@include('layouts.errors')
@if (session('dup_vid'))
    <div class="alert alert-danger alert-posts">
        {{ session('dup_vid') }}
    </div>
@endif

<!-- Modal Add -->
<div class="modal fade bd-example-modal-lg" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="cat_form" method="post" action="{{ route('category.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="role">Category</label>
                        <input type="text" name="categories" class="form-control" placeholder="Enter New Category" required>
                        <small id="errorlogTag" class="text-muted mt-2"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
