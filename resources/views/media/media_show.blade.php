@extends('layouts.app')

@section('active_library', 'active')
@section('heading')
    <i class="fas fa-photo-video text-secondary"></i> {{ $category->categories }}
@endsection

@section('content')
	<div class="media-frame zp-core-ui mode-grid hide-menu">
		<div class="media-frame-content" data-columns="11">
			<div class="attachment-browser hide-sidebar">
				<h2 class="media-views-heading sr-only">Attachment List</h2>
				<ul tabindex="-1" class="attachment ui-media">
					@foreach ($category->medias as $media)
						@php
							$arr = array(" ", ".", "(", ")", "_", "-");
							$arr2 = array("");
						@endphp
						<li class="attachment-list">
							<div class="attachment-preview type-image landscape">
								<div class="thumbnail" data-toggle="modal" data-target="{{ str_replace($arr, $arr2, '#m'.$category->cat_slug.$media->file_name) }}">
									<div class="centered">
										<i class="fas fa-file-video fa-5x"></i>
									</div>
									<div class="filename">
										<div>{{ $media->file_name }}</div>
									</div>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	
	@foreach ($category->medias as $media)
		<div class="modal fade media-model zp-core-ui" id="m{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog media-dialog" role="document">
				<div class="media-modal-content modal-content">
					<div class="edit-attachment-frame mode-select hide-menu hide-router">
						<div class="edit-media-header">
							<button type="button" data-dismiss="modal" aria-label="Close" class="close media-modal-close">
								<span aria-hidden="true" class="media-modal-icon">&times;</span></button>
						</div>
						<div class="media-frame-title">
							<h1 class="modal-title" id="exampleModalLongTitle">Attachment Details</h1>
						</div>
						<div class="media-frame-content">
							<div class="attachment-details save-ready">
								<div class="attachment-media-view landscape">
									<h2 class="sr-only">Attachment Preview</h2>
									<div class="thumbnail thumbnail-video">
										<span class="mejs-offscreen sr-only">Video Player</span>
										<div class="mejs-container zp-video-wrap">
											<video controls>
												<source src="{{ asset('storage/uploaded/media/'.$category->cat_slug.'/'.$media->file_name) }}" type="video/mp4">
											</video>												
										</div>

									</div>
								</div>
								<div class="attachment-info">
									<div class="details">
										<div class="filename"><strong>File name:</strong> {{ $media->file_name }}</div>
										@php
										$info = pathinfo('storage/uploaded/media/'.$category->cat_slug.'/'.$media->file_name);
										@endphp
										<div class="filename"><strong>File type:</strong> {{ $info['extension'] }}</div>
										<div class="uploaded"><strong>Uploaded on:</strong> {{ $media->created_at->format('M d, Y') }}</div>
										@php
										$bytes = filesize('storage/uploaded/media/'.$category->cat_slug.'/'.$media->file_name);
										if ($bytes >= 1024):
										$bytes = number_format($bytes / 1024, 2). 'KB';
										elseif($bytes >= 1048576):
										$bytes = number_format($bytes / 1048576, 2) . ' MB';
										endif
										@endphp
										<div class="file-size"><strong>File size:</strong> {{ $bytes }}</div>
										<div class="category"><strong>Categories:</strong>
											{{ $category->categories }}
										</div>
									</div>
									<div class="setting mb-1">
										<span class="name">Copy Link</span>
										<div class="input-group">
											<input id="copyIn{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" type="text" value="{{ asset('storage/uploaded/media/'.$category->cat_slug.'/'.$media->file_name) }}" class="form-control" readonly>
											<div class="input-group-append">
												<button id="copyIn{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" class="btn btn-success" onclick="copyFunction($(this).attr('id'))">Copy</button>
											</div>
										</div>
									</div>
									<div class="setting">
										<span class="name">Embeded iframe</span>
										<div class="input-group">
											<textarea class="form-control" aria-label="textarea" id="copyTa{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" readonly><iframe width="560" height="315" src="{{ asset('storage/uploaded/media/'.$category->cat_slug.'/'.$media->file_name) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></textarea>
											<div class="input-group-append">
												<button id="copyTa{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" class="btn btn-success" onclick="copyFunction($(this).attr('id'))">Copy</button>
											</div>
										</div>
									</div>
									<span class="clearfix"></span>
									<hr/>
									<div class="actions">
										<div class="form-group d-inline-flex">
											<form action="{{ route('media.destroy', ['category_id'=>$category->id, 'media_id'=>$media->id]) }}" method="POST">
												@csrf
												@method('DELETE')
												<button class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete {{ ucfirst($media->file_name) }} ?')">Delete</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					{{-- <div class="modal-body">
						<div class="form-group">
						</div>
					</div> --}}
				</div>
			</div>
		</div>
	@endforeach
@endsection