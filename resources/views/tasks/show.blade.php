
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
                <li><a href="{{ URL::to('tasks') }}">Create a Tasks</a>
            </ul>
        </nav>
    </div>

    <div class="container">
        <h1>Showing {{ $task->name }}</h1>

        <div class="jumbotron">
            <h2>{{ $task->name }}</h2>
            <p>
                <strong>Description: </strong> {{ $task->description }}
            </p>
        </div>
    </div>
@endsection
