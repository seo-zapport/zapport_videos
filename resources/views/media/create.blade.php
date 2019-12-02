@extends('layouts.app')
@section('active_add_media', 'active')
@section('heading')
    <i class="fas fa-photo-video text-secondary"></i> Media
@endsection

@section('content')
<form id="mediaForm" action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-9">
        <div class="media-attach-tools">
            <div class="media-form-wrap">
                <div class="uploader">
                    <h5 class="text-muted my-4">Select a files to upload</h5>
                    <label for="file_name" id="label_file_upload">
                            Select Files
                    </label>
                    <br>
                    <span id="slctdFile" class="text-muted mb-2 mt-2"></span>
                    <small id="errorlogMedia" class="text-muted mb-2 mt-2"></small>
                    <div class="uploader_wrap">
                        <input type="file" name="file_name" id="file_name" class="form-control-file" required>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div class="header-title"><p><strong>Categories</strong></p> <hr></div>
                <div class="form-group">
                    <a class="btn btn-block btn-outline-info" href="#" data-toggle="modal" data-target="#roleModal"><i class="fa fa-plus"></i> Add Category </a>
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
            <div class="card-body">
                <div class="header-title"><p><strong>Publish</strong></p> <hr></div>
                <div class="form-group">
                    <button id="pubMedia" class="btn btn-primary btn-block">Submit</button>
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
