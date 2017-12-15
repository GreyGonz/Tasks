@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Edit Task
@endsection

@section('main-content')
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


        <h1> Edit Task {{ $task->title }}</h1>

        {{ Form::model($task, array('url' => array('tasks', $task), 'method' => 'PUT' )) }}

        <div class="form-group">
            {{ Form::label('name', 'Name: ') }}
            {{ Form::text('name', $task->title, array('class' => "form-control", 'required' => 'required')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description: ') }}
            {{ Form::text('description', $task->description, array('class' => "form-control", 'required' => 'required')) }}
        </div>


        {{ Form::submit('TaskResource', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection