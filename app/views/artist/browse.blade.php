@extends('layout')

@section('section_header')
<h2>{{ $section_header }}</h2>
@stop

@section('section_label')
<h3>{{ $section_label }}</h3>
@stop

@section('content')

<p>
	<a href="{{ route('artist.add') }}" class="button"><span class="glyphicon glyphicon-plus"></span> Add an artist</a>
</p>

@if (!empty($artists))

<ul class="two-column-bubble-list">
	@foreach ($artists as $artist)
	<li>
		<div>
			<a href="{{ route('artist.edit', array('id' => $artist->artist_id) ) }}"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="{{ route('artist.delete', array('id' => $artist->artist_id) ) }}"><span class="glyphicon glyphicon-remove"></span></a>
			<a href="{{ route('artist.view', array('id' => $artist->artist_id) ) }}" title="[View {{ $artist->artist_display_name }}]">{{ $artist->artist_display_name }}</a>
		</div>
	</li>
	@endforeach
</ul>

@else

<p>
	No artists found.
</p>

@endif

@stop
