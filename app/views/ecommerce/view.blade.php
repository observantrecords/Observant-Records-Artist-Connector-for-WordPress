@extends('layout')

@section('page_title')
@stop

@section('section_header')
@stop

@section('section_label')
@stop

@section('content')

<p>
	<a href="{{ route('___.edit', array('id' => $___->id)) }}" class="button">Edit</a>
	<a href="{{ route('___.delete', array('id' => $____->id)) }}" class="button">Delete</a>
</p>

@stop
