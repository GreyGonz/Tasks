
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Create task
@endsection

@section('main-content')

    @if (Session::get('status') )
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('tasks') }}">Tasks</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('tasks') }}">View All Tasks</a></li>
                <li><a href="{{ URL::to('tasks/create') }}">Create a Task</a>
            </ul>
        </nav>

        {{ Session::get('status') }}

        {{ Form::open(array('url' => 'tasks')) }}

        {{ csrf_field() }}
            <div class="form-group">
                {{ Form::label('name', 'Name: ') }}
                {{ Form::text('name', null, array('class' => "form-control")) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description: ') }}
                {{ Form::text('description', null, array('class' => "form-control")) }}
            </div>

            <div class="form-group">
                {{ Form::label('user_id', 'User ID: ') }}
                {{ Form::select('user_id', $users, array('class' => "form-control")) }}
            </div>

            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@endsection
