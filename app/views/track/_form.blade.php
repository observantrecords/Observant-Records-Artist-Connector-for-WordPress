@extends('layout')

@section('content')

{{ Form::model( $track, array( 'route' => array( 'track.update', $track->track_id ), 'class' => 'form-horizontal', 'role' => 'form' ) ) }}

<div class="form-group">

	{{ Form::hidden( 'track_release_id', $track->release->release_id ) }}
	{{ Form::hidden( 'track_album_id', $track->release->album->album_id ) }}

	<div class="form-group">
		{{ Form::label( 'track_disc_num', 'Disc no.:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			{{ Form::text( 'track_track_num', $track->track_disc_num, array( 'class' => 'form-control' ) ) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_track_num', 'Track no.:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			{{ Form::text( 'track_track_num', $track->track_track_num, array( 'class' => 'form-control' ) ) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_song_id', 'Song:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			{{ Form::select( 'track_song_id', $songs, $track->track_song_id, array( 'class' => 'form-control' ) ) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_alias', 'Alias:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			{{ Form::text( 'track_alias', $track->track_alias, array( 'class' => 'form-control' ) ) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_is_visible', 'Visibility:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			<div class="radio">
				<label>
					{{ Form::radio( 'track_is_visible', true, (boolean) $track->track_is_visible ) }} Show
				</label>
			</div>
			<div class="radio">
				<label>
					{{ Form::radio( 'track_is_visible', false, (boolean) $track->track_is_visible ) }} Hide
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_audio_is_linked', 'Playable:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			<div class="radio">
				<label>
					{{ Form::radio( 'track_audio_is_linked', true, (boolean) $track->track_audio_is_linked ) }} Yes
				</label>
			</div>
			<div class="radio">
				<label>
					{{ Form::radio( 'track_audio_is_linked', false, (boolean) $track->track_audio_is_linked ) }} No
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_audio_is_downloadable', 'Downloadable:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			<div class="radio">
				<label>
					{{ Form::radio( 'track_audio_is_downloadable', true, (boolean) $track->track_audio_is_downloadable ) }} Yes
				</label>
			</div>
			<div class="radio">
				<label>
					{{ Form::radio( 'track_audio_is_downloadable', false, (boolean) $track->track_audio_is_downloadable ) }} No
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_uplaya_score', 'uPlaya score:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			{{ Form::text( 'track_uplaya_score', $track->track_uplaya_score, array( 'class' => 'form-control' ) ) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_audio_is_downloadable', 'Downloadable:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			<div class="radio">
				<label>
					{{ Form::radio( 'track_audio_is_downloadable', true, (boolean) $track->track_audio_is_downloadable ) }} Yes
				</label>
			</div>
			<div class="radio">
				<label>
					{{ Form::radio( 'track_audio_is_downloadable', false, (boolean) $track->track_audio_is_downloadable ) }} No
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label( 'track_recording_id', 'Recording:', array( 'class' => 'col-sm-2' ) ) }}
		<div class="col-sm-10">
			{{ Form::select( 'track_recording_id', $recordings, $track->track_recording_id, array( 'class' => 'form-control' ) ) }}
		</div>
	</div>

	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Save') }}
	</div>
</div>

{{ Form::close() }}

<script type="text/javascript">
	(function ($) {
		$('#track_song_id').chosen();
		$('#track_recording_id').chosen();

		// Date pickers.
//		$('#release_release_date').datepicker({
//			dateFormat: 'yy-mm-dd'
//		});

		$('#track_song_id').change(function () {
			var alias = $('#track_song_id>option:selected').text().trim().toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]+/g, '').replace(/(^-|-$)/, '');
			$('#track_alias').val(alias);
		});
	})(jQuery);
</script>

@stop