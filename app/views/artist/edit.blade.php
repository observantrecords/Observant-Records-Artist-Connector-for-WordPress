@extends('artist._form')

@section('page_title')
 &raquo; Artists
@if (!empty($artist->artist_display_name))
 &raquo; Edit &raquo; {{ $artist->artist_display_name }}
@else
 &raquo; Add a new artist
@endif
@stop

@section('section_header')
<h2>Artists</h2>
@stop

@section('section_label')
<h3>
	@if (!empty($artist->artist_display_name))
	Edit {{ $artist->artist_display_name }}
	@else
	Add a new artist
	@endif
</h3>
@stop

@section('content')
@parent
@stop
