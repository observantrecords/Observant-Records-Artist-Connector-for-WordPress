@extends('layout')

@section('page_title')
 &raquo; {{ $track->release->album->artist->artist_display_name }}
 &raquo; {{ $track->release->album->album_title }}
 &raquo; {{ $track->release->release_catalog_num }}
 &raquo; {{ $track->song->song_title }}
@stop

@section('section_header')
@stop

@section('section_label')
@stop

@section('content')
@endif

@stop
