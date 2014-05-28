@extends('layout')

@section('content')

{{ Form::model( $___model, array( 'route' => array( '____.update', $____->id ), 'class' => 'form-horizontal', 'role' => 'form' ) ) }}


{{ Form::close() }}

<script type="text/javascript">
	(function ($) {
	})(jQuery);
</script>

@stop