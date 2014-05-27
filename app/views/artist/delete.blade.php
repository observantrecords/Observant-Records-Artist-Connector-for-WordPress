@extends('layout')

@section('page_title')
 &raquo; Artists &raquo; Delete
@if (!empty($artist->artist_display_name))
 &raquo; {{ $artist->artist_display_name }}
@endif
@stop

@section('section_header')
<h2>Artists</h2>
@stop

@section('section_label')
<h3>
	Delete
	@if (!empty($artist->artist_display_name))
	{{ $artist->artist_display_name }}
	@endif
</h3>
@stop

@section('content')

<p>
	You are about to delete <strong>{{ $artist->artist_display_name }}</strong> from the database. Deleting an artist also removes all albums, releases and tracks related to this artist.
</p>

<p>
	Are you sure you want to do this?
</p>

{{ Form::open( array( 'route' => array( 'artist.remove', $artist->artist_id ) ) ) }}

<div class="radio">
	<label>
		{{ Form::radio('confirm', '1') }} Yes, I want to delete {{ $artist->artist_display_name }}.
	</label>
</div>
<div class="radio">
	<label>
		{{ Form::radio('confirm', '0') }} No, I don't want to delete {{ $artist->artist_display_name }}.
	</label>
</div>

<p>
	{{ Form::submit('Confirm') }}
</p>

{{ Form::close() }}

@stop
