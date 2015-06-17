@extends('layout')

@section('content')

    <div class="form-group">
        {!! Form::label( 'user_name', 'User name:', array( 'class' => 'col-sm-2 control-label' ) ) !!}
        <div class="col-sm-10">
            {!! Form::text( 'user_name', $user->user_name, array( 'class' => 'form-control' ) ) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label( 'user_email', 'E-mail:', array( 'class' => 'col-sm-2 control-label' ) ) !!}
        <div class="col-sm-10">
            {!! Form::text( 'user_email', $user->user_email, array( 'class' => 'form-control' ) ) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <ul class="list-inline">
                <li>{!! Form::submit( 'Save', array( 'class' => 'btn btn-primary' ) ) !!}</li>
                <li>
                    @if (!empty( $user->user_id))
                        <a href="{{ route( 'user.show', array( 'id' => $user->user_id ) ) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route( 'user.index' ) }}" class="btn btn-default">Cancel</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>

@stop