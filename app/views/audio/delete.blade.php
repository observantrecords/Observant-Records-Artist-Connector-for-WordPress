@extends('layout')

@section('page_title')
@stop

@section('section_header')
@stop

@section('section_label')
@stop

@section('content')

<p>
	You are about to delete <strong>{{  }}</strong> from the database.
</p>

<p>
	Are you sure you want to do this?
</p>

{{ Form::open( array( 'route' => array( '___.remove', $___->id ) ) ) }}

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
