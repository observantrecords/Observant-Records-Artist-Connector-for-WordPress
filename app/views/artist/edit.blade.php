@extends('artist._form')

@section('section_header')
<h2>{{ $section_header }}</h2>
@stop

@section('section_label')
<h3>{{ $section_label }}</h3>
@stop

@section('content')
@parent
@stop
