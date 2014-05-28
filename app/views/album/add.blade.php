@extends('album._form')

@section('page_title')
 &raquo; {{ $album->artist->artist_display_name }}
 &raquo; Album
 &raquo; Add
@stop

@section('section_header')
<h2>{{ $album->artist->artist_display_name }}</h2>
@stop

@section('section_label')
<h3>Add a new album</h3>
@stop

@section('content')
@parent
@stop
