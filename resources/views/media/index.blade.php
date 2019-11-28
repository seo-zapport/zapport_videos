@extends('layouts.app')

@section('active_library', 'active')
@section('heading')
    <i class="fas fa-photo-video text-secondary"></i> Library
@endsection

@section('content')

<div class="card">
	<div class="card-body p-3">
		<div class="table-responsive">
			<table class="table table-striped table-hover mb-0">
				<thead class="thead-dark">
					<tr>
						<th>Name</th>
						<th width="10%">No.Video</th>
						<th width="10%">Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td>

								<a href="{{ route('cat.show', ['category' => $category->cat_slug]) }}" style="font-weight: 600">{{ $category->categories }}</a>
								<div class="row-actions">
									<a href="{{ route('cat.show', ['category' => $category->cat_slug]) }}" class="text-secondary"><small><i class="far fa-eye"></i> View</small></a>
								</div>
							</td>
							<td width="10%">0</td>
							<td width="10%">{{ date('Y/m/d', strtotime($category->created_at)) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>		
	</div>
</div>

	
{{-- <div class="row">
	<div class="col-3">
		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			@foreach ($categories as $category)
				@if (count($category->medias) > 0)
					<a class="nav-link" id="v-pills-{{ $category->cat_slug }}-tab" data-toggle="pill" href="#v-pills-{{ $category->cat_slug }}" role="tab" aria-controls="v-pills-{{ $category->cat_slug }}" aria-selected="false">{{ $category->categories }}</a>
				@endif
			@endforeach
		</div>
	</div>
	<div class="col-9">
		<div class="tab-content" id="v-pills-tabContent">
			@foreach ($categories as $category)
				<div class="tab-pane fade" id="v-pills-{{ $category->cat_slug }}" role="tabpanel" aria-labelledby="v-pills-{{ $category->cat_slug }}-tab">
					<div class="row">
						@foreach ($category->medias as $media)
							@php
								$arr = array(" ", ".", "(", ")", "_", "-");
								$arr2 = array("");
							@endphp
							<div class="col-md-3">
								<div class="card" data-toggle="modal" data-target="{{ str_replace($arr, $arr2, '#m'.$category->cat_slug.$media->file_name) }}">
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
				</div>
			@endforeach
		</div>
	</div>
</div>

@foreach ($categories as $category)
	@foreach ($category->medias as $media)
		<div class="modal fade bd-example-modal-lg" id="m{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">{{ ucfirst($media->file_name) }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
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
						<hr>
						<div class="form-group">
						<input id="copy{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" type="text" value="{{ asset('storage/uploaded/media/'.$category->cat_slug.'/'.$media->file_name) }}" class="form-control">
						</div>
						<div class="form-group d-inline-flex">
						<button id="copy{{ str_replace($arr, $arr2, $category->cat_slug).str_replace($arr, $arr2, $media->file_name) }}" class="btn btn-success mr-2" onclick="copyFunction($(this).attr('id'))">Copy</button>
						<form action="{{ route('media.destroy', ['category_id'=>$category->id, 'media_id'=>$media->id]) }}" method="POST">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ ucfirst($media->file_name) }} ?')">Delete</button>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endforeach --}}

@endsection