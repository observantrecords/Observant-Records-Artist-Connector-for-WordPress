@extends('release._form')

@section('page_title')
 &raquo; {{ $release->album->artist->artist_display_name }}
 &raquo; {{ $release->album->album_title }}
 &raquo; Add a release
@stop

@section('section_header')
<hgroup>
	<h2>
		{{ $release->album->artist->artist_display_name }}
		<small>{{ $release->album->album_title }}</small>
	</h2>
</hgroup>
@stop

@section('section_label')
<h3>Add a release</h3>
@stop

@section('content')
@parent
@stop
