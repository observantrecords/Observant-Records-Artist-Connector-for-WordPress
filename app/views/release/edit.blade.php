@extends('release._form')

@section('page_title')
 &raquo; {{ $release->album->artist->artist_display_name }}
 &raquo; {{ $release->album->album_title }}
 @if (!empty($release->release_catalog_num)) &raquo; {{ $release->release_catalog_num }} @endif
 &raquo; Edit
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
<h3>
	Edit release
	@if (!empty($release->release_catalog_num))
	<small>{{ $release->release_catalog_num }}</small>
	@endif
</h3>
@stop

@section('content')
@parent
@stop
