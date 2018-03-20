@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Timeline de tasques
@endsection

@section('main-content')

  <div class="box" id="timeline">
    <div class="box-header with-border">
      <h3 class="box-title">Tasks timeline</h3>
    </div>
    <div class="box-body">
      <a class="btn btn-primary" href="/timeline">Refresh</a>
      <a href="btn btn-danger" href=""></a>
    </div>
    <div class="box-body">
      <!-- The timeline -->
      <ul class="timeline timeline-inverse">
        <!-- timeline time label -->
        <li class="time-label">
                  <span class="bg-red">
                    {{ $actualDate = date('d D Y', strtotime($task_events->first()->time)) }}
                  </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        @foreach($task_events as $event)

          @if(date('d D Y', strtotime($event->time)) != $actualDate )
            <li class="time-label">
                  <span class="bg-red">
                    {{ $actualDate = date('d D Y', strtotime($event->time)) }}
                  </span>
            </li>
          @endif
          @switch($event->type)
            @case('created')
              <li>
                <i class="fa fa-plus bg-green"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($event->time)) }}</span>

                  <h3 class="timeline-header"><a href="#">{{ $event->user_name }}</a> {{ $event->type }} a task</h3>

                  <div class="timeline-body">
                    <h4>{{ json_decode($event->task)->name }}</h4>
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-xs" href="{{ '/tasks/'.json_decode($event->task)->id }}">Show task</a>
                    {{--<a class="btn btn-danger btn-xs">Delete</a>--}}
                  </div>
                </div>
              </li>
              @break
            @case('updated')
              <li>
                <i class="fa fa-wrench bg-blue"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($event->time)) }}</span>

                  <h3 class="timeline-header"><a href="#">{{ $event->user_name }}</a> {{ $event->type }} a task</h3>

                  <div class="timeline-body">
                    <h4>{{ json_decode($event->task)->name }}</h4>
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-xs" href="{{ '/tasks/'.json_decode($event->task)->id }}">Show task</a>
                    {{--<a class="btn btn-danger btn-xs">Delete</a>--}}
                  </div>
                </div>
              </li>
              @break
            @case('deleted')
              <li>
                <i class="fa fa-trash bg-red"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($event->time)) }}</span>

                  <h3 class="timeline-header"><a href="#">{{ $event->user_name }}</a> {{ $event->type }} a task</h3>

                  <div class="timeline-body">
                    <h4>{{ json_decode($event->task)->name }}</h4>
                  </div>
                  <div class="timeline-footer">
                    {{--<a class="btn btn-danger btn-xs">Delete</a>--}}
                  </div>
                </div>
              </li>
              @break
          @endswitch
        @endforeach
        <li>
          <i class="fa fa-clock-o bg-gray"></i>
        </li>
      </ul>
    </div>
  </div>

@endsection

