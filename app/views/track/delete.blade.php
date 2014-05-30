@extends('layout')

@section('page_title')
 &raquo; {{ $track->release->album->artist->artist_display_name }}
 &raquo; {{ $track->release->album->album_title }}
@if (!empty($release->release_catalog_num)) &raquo; {{ $release->release_catalog_num }} @endif
 &raquo; {{ $track->song->song_title }}
 &raquo; Delete
@stop

@section('section_header')
<hgroup>
	<h2>
		{{ $track->release->album->artist->artist_display_name }}
		<small>{{ $track->release->album->album_title }}</small>
	</h2>
</hgroup>
@stop

@section('section_label')
<h3>
	Delete
	<small>{{ $track->song->song_title }}</small>
</h3>
@stop

@section('content')

<p>
	You are about to delete <strong>{{ $track->song->song_title }}</strong> from the database.
</p>

<p>
	Are you sure you want to do this?
</p>

{{ Form::open( array( 'route' => array( 'track.remove', $track->track_id ) ) ) }}

<div class="radio">
	<label>
		{{ Form::radio('confirm', '1') }} Yes, I want to delete {{ $track->song->song_title }}.
	</label>
</div>
<div class="radio">
	<label>
		{{ Form::radio('confirm', '0') }} No, I don't want to delete {{ $track->song->song_title }}.
	</label>
</div>

<p>
	{{ Form::submit('Confirm') }}
</p>

{{ Form::close() }}

@stop
