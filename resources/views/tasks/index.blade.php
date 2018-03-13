
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Tasks PHP
@endsection

@section('main-content')

    @if (Session::get('status') )
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ Session::get('status') }}
        </div>
    @endif

    <div class="container-fluid">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand box-title" href="{{ URL::to('tasks') }}">Tasks</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('tasks') }}">View All Tasks</a></li>
                <li><a href="{{ URL::to('tasks/create') }}">Create a Task</a>
            </ul>
        </nav>

        {{ Session::get('status') or ''}}

        <table class="table table-striped table-bordered box">
            <thead>
                <td>id</td>
                <td>user id</td>
                <td>name</td>
                <td>description</td>
                <td>completed</td>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->user_id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->completed }}</td>
                    <td>
                        {{ Form::open(array('url' => '/tasks/' . $task->id,'class' => 'pull-right', 'method' => 'DELETE')) }}
                        {{ Form::submit('Delete this task', array('id' => 'delete-task-' . $task->id, 'class' => 'btn btn-small btn-warning')) }}
                        {{ Form::close() }}

                        <a id="{{ 'show-task-' . $task->id }}" class="btn btn-small btn-success pull-right" href="{{ URL::to('/tasks/' . $task->id) }}">Show this Task</a>

                        <a id="{{ 'edit-task-' . $task->id }}"class="btn btn-small btn-info pull-right" href="{{ URL::to('/tasks/' . $task->id . '/edit') }}">Edit this Task</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
