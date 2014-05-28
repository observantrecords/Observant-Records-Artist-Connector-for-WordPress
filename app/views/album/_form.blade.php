@extends('layout')

@section('content')

{{ Form::model( $album, array( 'route' => array( 'album.update', $album->album_id ), 'class' => 'form-horizontal', 'role' => 'form' ) ) }}

<div class="form-group">
	{{ Form::label( 'album_title', 'Title:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'album_title', $album->album_title, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'album_alias', 'Alias:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'album_alias', $album->album_alias, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'album_release_date', 'Release date:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'album_release_date', date('Y-m-d', strtotime($album->album_release_date)), array( 'class' => 'form-control' ) ) }}
	</div>
</div>

@if (!empty($album->album_id))
<div class="form-group">
	{{ Form::label( 'album_primary_release_id', 'Primary release:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::select( 'album_primary_release_id', $releases, $album->album_primary_release_id, array( 'class' => 'form-control' ) ) }}
	</div>
</div>
@endif

<div class="form-group">
	{{ Form::label( 'album_ctype_locale', 'Primary release:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::select( 'album_ctype_locale', $locales, $album->album_ctype_locale, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'album_format_id', 'Format:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::select( 'album_format_id', $formats, $album->album_format_id, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'album_image', 'Image:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'album_image', $album->album_image, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'album_description', 'Description:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::textarea( 'album_description', $album->album_description, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'album_is_visible', 'Visibility:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		<div class="radio">
			<label>
				{{ Form::radio( 'album_is_visible', true, (boolean) $album->album_is_visible ) }} Show
			</label>
		</div>
		<div class="radio">
			<label>
				{{ Form::radio( 'album_is_visible', false, (boolean) $album->album_is_visible ) }} Hide
			</label>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::hidden( 'album_artist_id' , $album->album_artist_id) }}
		{{ Form::submit( 'Save' ) }}
	</div>
</div>

{{ Form::close() }}

<script type="text/javascript">
	(function ($) {
		$('#album_primary_release_id').chosen();
		$('#album_format_id').chosen();

		// Date pickers.
		$('#album_release_date').datepicker({
			dateFormat: 'yy-mm-dd'
		});

		$('#album_title').keyup(function () {
			var alias = this.value.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]+/g, '').replace(/(^-|-$)/, '');
			$('#album_alias').val(alias);
		});
	})(jQuery);
</script>

@stop