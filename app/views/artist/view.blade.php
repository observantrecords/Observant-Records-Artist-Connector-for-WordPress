@extends('layout')

@section('page_title')
 &raquo; Artists &raquo; View
@if (!empty($artist->artist_display_name))
 &raquo; {{ $artist->artist_display_name }}
@endif
@stop

@section('section_header')
<h2>Artists</h2>
@stop

@section('section_label')
<h3>
	View
	@if (!empty($artist->artist_display_name))
	{{ $artist->artist_display_name }}
	@endif
</h3>
@stop

@section('content')

<p>
	<a href="{{ route('artist.edit', array('id' => $artist->artist_id)) }}" class="button">Edit</a>
	<a href="{{ route('artist.delete', array('id' => $artist->artist_id)) }}" class="button">Delete</a>
</p>

<ul class="two-column-bubble-list">
	<li>
		<div>
			<label>Last name:</label> {{ $artist->artist_last_name }}
		</div>
	</li>
	@if (!empty($artist->artist_first_name))
	<li>
		<div>
			<label>First name:</label> {{ $artist->artist_first_name }}
		</div>
	</li>
	@endif
	@if (!empty($artist->artist_display_name))
	<li>
		<div>
			<label>Display name:</label> {{ $artist->artist_display_name }}
		</div>
	</li>
	@endif
	@if (!empty($artist->artist_alias))
	<li>
		<div>
			<label>Alias:</label> {{ $artist->artist_alias }}
		</div>
	</li>
	@endif
	@if (!empty($artist->artist_url))
	<li>
		<div>
			<label>URL:</label> <a href="{{ $artist->artist_url }}">{{ $artist->artist_url }}</a>
		</div>
	</li>
	@endif
</ul>

@if (count($albums) > 0)
<h3>Albums</h3>

<ol class="track-list">
	@foreach ($albums as $album)
	<li>
		<div>
			<a href="{{ route( 'album.edit', array( 'id' => $album->album_id ) ) }}"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="{{ route( 'album.delete', array( 'id' => $album->album_id ) ) }}"><span class="glyphicon glyphicon-remove"></span></a>
			<span class="album-order-display">{{ $album->album_order }}</span>. <a href="{{ route( 'album.view', array( 'id' => $album->album_id ) ) }}">{{ $album->album_title }}</a>
			{{ Form::hidden('album_id', $album->album_id) }}
			{{ Form::hidden('album_order', $album->album_order) }}
		</div>
	</li>
	@endforeach
</ol>
@endif

@stop
