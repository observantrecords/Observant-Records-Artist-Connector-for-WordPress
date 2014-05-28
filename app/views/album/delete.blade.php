@extends('layout')

@section('page_title')
 &raquo; {{ $album->artist->artist_display_name }}
 &raquo; {{ $album->album_title }}
 &raquo; Delete
@stop

@section('section_header')
<h2>{{ $album->artist->artist_display_name }}</h2>
@stop

@section('section_label')
<h3>Delete {{ $album->album_title }}</h3>
@stop

@section('content')

<p>
	You are about to delete <strong><em>{{ $album->album_title }}</em></strong> from the database. Deleting an album also removes all releases and tracks related to this album.
</p>

<p>
	Are you sure you want to do this?
</p>

{{ Form::open( array( 'route' => array( 'album.remove', $album->album_id ) ) ) }}

<div class="radio">
	<label>
		{{ Form::radio('confirm', '1') }} Yes, I want to delete {{ $album->album_title }}.
	</label>
</div>
<div class="radio">
	<label>
		{{ Form::radio('confirm', '0') }} No, I don't want to delete {{ $album->album_title }}.
	</label>
</div>

<p>
	{{ Form::submit('Confirm') }}
</p>

{{ Form::close() }}

@stop
