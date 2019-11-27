@extends('layouts.app')

@section('content')

<div class="row">
	@foreach ($medias as $media)
	@php
		$arr = array(" ", ".", "(", ")", "_", '-');
		$arr2 = array("");
	@endphp
	<div class="col-md-2">
		<div class="card" data-toggle="modal" data-target="{{ str_replace($arr, $arr2, '#modal'.$media->file_name) }}">
			<div class="card-body text-center">
				<i class="fas fa-file-video fa-5x"></i>
			</div>
			<div class="card-footer">
				{{ $media->file_name }}
			</div>
		</div>
	</div>
	@endforeach
</div>
@foreach ($medias as $media)
	<!-- Modal Add -->
	<div class="modal fade bd-example-modal-lg" id="modal{{ str_replace($arr, $arr2, $media->file_name) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLongTitle">{{ ucfirst($media->file_name) }}</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	            	@foreach ($media->categories as $cat)
	            		@if ($loop->first)
						<div class="details">
							<div class="filename"><strong>File name:</strong> {{ $media->file_name }}</div>
							@php
								$info = pathinfo('storage/uploaded/media/'.$cat->cat_slug.'/'.$media->file_name);
							@endphp
							<div class="filename"><strong>File type:</strong> {{ $info['extension'] }}</div>
							<div class="uploaded"><strong>Uploaded on:</strong> {{ $media->created_at->format('M d, Y') }}</div>
							@php
								$bytes = filesize('storage/uploaded/media/'.$cat->cat_slug.'/'.$media->file_name);
								if ($bytes >= 1024):
									$bytes = number_format($bytes / 1024, 2). 'KB';
								elseif($bytes >= 1048576):
									$bytes = number_format($bytes / 1048576, 2) . ' MB';
								endif
							@endphp
							<div class="file-size"><strong>File size:</strong> {{ $bytes }}</div>
							@php
								list($width, $height) = getimagesize('storage/uploaded/media/'.$cat->cat_slug.'/'.$media->file_name);
							@endphp
							<div class="dimensions"><strong>Dimensions:</strong> {{ $width .' x '. $height }}</div>
							<div class="category"><strong>Categories:</strong>
								@foreach ($media->categories as $category)
									{{ $category->categories . ', ' }}
								@endforeach
							</div>
						</div>
	            		@endif
	            	@endforeach
					<hr>
	            	<div class="form-group">
	            		@foreach ($media->categories as $cat)
		            		<input type="text" value="{{ asset('storage/uploaded/media/'.$cat->cat_slug.'/'.$media->file_name) }}" class="form-control">
	            		@endforeach
	            	</div>
	            	<div class="form-group">
	            		<button class="btn btn-success">Copy</button>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
@endforeach
@endsection