
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Create task
@endsection

@section('main-content')
    <div class="container-fluid">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('tasks') }}">Tasks</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('tasks') }}">View All Tasks</a></li>
                <li><a href="{{ URL::to('tasks/create') }}">Create a Tasks</a>
            </ul>
        </nav>

        {{ Session::get('status') }}

        {{ Form::open(array('url' => 'tasks')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name: ') }}
            {{ Form::text('name', null, array('class' => "form-control", 'required' => 'required')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description: ') }}
            {{ Form::text('description', null, array('class' => "form-control", 'required' => 'required')) }}
        </div>

        {{ Form::submit('TaskResource', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@endsection
