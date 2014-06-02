@extends('audio._form')

@section('page_title')
@stop

@section('section_header')
@stop

@section('section_label')
@stop

@section('content')
{{ Form::model( $audio, array( 'route' => 'audio.update', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'put' ) ) }}
@parent
{{ Form::close()}}
@stop

@section('sidebar')
@if (!empty($audio->audio_file_server) && !empty($audio->audio_file_name) && !empty($audio->audio_file_path))
<h4>Listen</h4>

<p>
	<audio id="file_preview" controls>
		<source src="http://{{ $audio->audio_file_server }}{{ $audio->audio_file_path }}/{{ $audio->audio_file_name }}" type="{{ $audio->audio_file_type }}" />
	</audio>
</p>
@endif
@stop