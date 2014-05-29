@extends('layout')

@section('content')

{{ Form::model( $___model, array( 'route' => array( '____.update', $____->id ), 'class' => 'form-horizontal', 'role' => 'form' ) ) }}

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