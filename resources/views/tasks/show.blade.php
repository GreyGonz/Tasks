
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
                <li><a href="{{ URL::to('tasks/' . $task->id . '/edit/' ) }}">Edit Task</a></li>
            </ul>
        </nav>
    </div>

    {{ Session::get('status') }}

    <div class="container">
        <h1>Showing {{ $task->name }}</h1>

        <div class="jumbotron">
            <h2 class="name">{{ $task->name }}</h2>
            <p class="description">
                <strong>Description: </strong> {{ $task->description }}
            </p>
        </div>
    </div>
@endsection
