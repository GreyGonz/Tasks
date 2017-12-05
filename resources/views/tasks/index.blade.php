
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Tasks PHP
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

        <table class="table table-striped table-bordered">
            <thead>
                <td>id</td>
                <td>name</td>
                <td>description</td>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        {{ Form::open(array('url' => 'tasks/' . $task->id, 'class' => 'pull-right', 'method' => 'DELETE')) }}
                        {{ Form::submit('Delete this Thread', array('class' => 'btn btn-small btn-warning')) }}
                        {{ Form::close() }}

                        <a class="btn btn-small btn-success pull-right" href="{{ URL::to('/tasks/' . $task->id) }}">Show this Task</a>

                        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('/tasks/' . $task->id . '/edit') }}">Edit this Task</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
