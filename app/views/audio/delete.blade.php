@extends('layout')

@section('page_title')
@stop

@section('section_header')
@stop

@section('section_label')
@stop

@section('content')

<p>
	You are about to delete <strong>{{ $audio->audio_file_name }}</strong> from the database.
</p>

<p>
	Are you sure you want to do this?
</p>

{{ Form::model( $audio, array( 'route' => array( 'audio.destroy', $audio->audio_id), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'delete' ) ) }}

<div class="form-group">
	<div class="col-sm-12">
		<div class="radio">
			<label>
				{{ Form::radio('confirm', '1') }} Yes, I want to delete {{ $audio->audio_file_name }}.
			</label>
		</div>
		<div class="radio">
			<label>
				{{ Form::radio('confirm', '0') }} No, I don't want to delete {{ $audio->audio_file_name }}.
			</label>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-12">
		{{ Form::hidden('audio_recording_id', $audio->audio_recording_id) }}
		{{ Form::submit('Confirm', array( 'class' => 'button' )) }}
	</div>

</div>


{{ Form::close() }}

@stop
