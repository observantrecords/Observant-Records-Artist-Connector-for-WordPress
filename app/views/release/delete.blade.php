@extends('layout')

@section('page_title')
 &raquo; {{ $release->album->artist->artist_display_name }}
 &raquo; {{ $release->album->album_title }}
 @if (!empty($release->release_catalog_num)) &raquo; {{ $release->release_catalog_num }} @endif
 &raquo; Delete
@stop

@section('section_header')
@stop

@section('section_label')
@stop

@section('content')

<p>
	You are about to delete a release @if (!empty($release->release_catalog_num)) <strong>{{ $release->release_catalog_num }}</strong> @endif from the album <em>{{ $release->album->album_title  }}</em>. Deleting a release will also remove all related tracks.
</p>

<p>
	Are you sure you want to do this?
</p>

{{ Form::open( array( 'route' => array( 'release.remove', $release->release_id ) ) ) }}

<div class="radio">
	<label>
		{{ Form::radio('confirm', '1') }} Yes, I want to delete this release.
	</label>
</div>
<div class="radio">
	<label>
		{{ Form::radio('confirm', '0') }} No, I don't want to delete this release.
	</label>
</div>

<p>
	{{ Form::submit('Confirm') }}
</p>

{{ Form::close() }}

@stop
