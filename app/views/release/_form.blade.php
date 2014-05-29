@extends('layout')

@section('content')

{{ Form::model( $release, array( 'route' => array( 'release.update', $release->release_id ), 'class' => 'form-horizontal', 'role' => 'form' ) ) }}

<div class="form-group">
	{{ Form::label( 'release_album_id', 'Album:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::select( 'release_album_id', $albums, $release->release_album_id, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_alternate_title', 'Alternate title:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_alternate_title', $release->release_alternate_title, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_alias', 'Alias:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_alias', $release->release_alias, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_label', 'Label:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_label', $release->release_label, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_release_date', 'Release date:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_release_date', date('Y-m-d', strtotime($release->release_release_date) ), array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_upc_num', 'Release date:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_upc_num', $release->release_upc_num, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_catalog_num', 'Catalog no.:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_catalog_num', $release->release_catalog_num, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_format_id', 'Format:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::select( 'release_format_id', $formats, $release->release_format_id, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_image', 'Image:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::text( 'release_image', $release->release_image, array( 'class' => 'form-control' ) ) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label( 'release_is_visible', 'Visibility:', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		<div class="radio">
			<label>
				{{ Form::radio( 'release_is_visible', true, (boolean) $release->release_is_visible ) }} Show
			</label>
		</div>
		<div class="radio">
			<label>
				{{ Form::radio( 'release_is_visible', false, (boolean) $release->release_is_visible ) }} Hide
			</label>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Save') }}
	</div>
</div>

{{ Form::close() }}

<script type="text/javascript">
	(function ($) {
	})(jQuery);
</script>

@stop