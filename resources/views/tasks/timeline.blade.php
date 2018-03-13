@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Timeline de tasques
@endsection

@section('main-content')
  {{--<div class="box">--}}
    {{--<div class="box-header with-border">--}}
      {{--<h3 class="box-title">Timeline</h3>--}}
    {{--</div>--}}
    {{--<ul>--}}
      {{--@foreach ($task_events as $event)--}}
        {{--<li>User {{ $event->user_name }} {{ $event->type }} task {{ $event->task_name }} at {{ $event->time }}</li>--}}

        {{--$response->assertSee("User " . $user->name . " created task " . $task->name ." at " . $task->created_at);--}}
        {{--$response->assertSee("User " . $user->name . " retrieved task " . $task->name . " at ");--}}
        {{--$response->assertSee("User " . $user->name . " updated task " . $task->name . " at "); // PAYLOAD: informar nom antetior nom nou--}}
        {{--$response->assertSee("User " . $user->name . " deleted task " . $task->name . " at "); // PAYLOAD: informar nom antetior nom nou--}}

      {{--@endforeach--}}

      <div class="tab-pane active" id="timeline">
        <!-- The timeline -->
        <ul class="timeline timeline-inverse">
          <!-- timeline time label -->
          <li class="time-label">
                      <span class="bg-red">
                        10 Feb. 2014
                      </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          @foreach($task_events as $event)
            <li>
              <i class="fa fa-tasks bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>{{ $event->time }}</span>

                <h3 class="timeline-header"><a href="#">{{ $event->user_name }}</a> {{ $event->type }}</h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  {{--<a class="btn btn-primary btn-xs">Read more</a>--}}
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
          @endforeach
          {{--<li>--}}
            {{--<i class="fa fa-envelope bg-blue"></i>--}}

            {{--<div class="timeline-item">--}}
              {{--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>--}}

              {{--<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>--}}

              {{--<div class="timeline-body">--}}
                {{--Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,--}}
                {{--weebly ning heekya handango imeem plugg dopplr jibjab, movity--}}
                {{--jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle--}}
                {{--quora plaxo ideeli hulu weebly balihoo...--}}
              {{--</div>--}}
              {{--<div class="timeline-footer">--}}
                {{--<a class="btn btn-primary btn-xs">Read more</a>--}}
                {{--<a class="btn btn-danger btn-xs">Delete</a>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<!-- END timeline item -->--}}
          {{--<!-- timeline item -->--}}
          {{--<li>--}}
            {{--<i class="fa fa-user bg-aqua"></i>--}}

            {{--<div class="timeline-item">--}}
              {{--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>--}}

              {{--<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request--}}
              {{--</h3>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<!-- END timeline item -->--}}
          {{--<!-- timeline item -->--}}
          {{--<li>--}}
            {{--<i class="fa fa-comments bg-yellow"></i>--}}

            {{--<div class="timeline-item">--}}
              {{--<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>--}}

              {{--<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>--}}

              {{--<div class="timeline-body">--}}
                {{--Take me to your leader!--}}
                {{--Switzerland is small and neutral!--}}
                {{--We are more like Germany, ambitious and misunderstood!--}}
              {{--</div>--}}
              {{--<div class="timeline-footer">--}}
                {{--<a class="btn btn-warning btn-flat btn-xs">View comment</a>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<!-- END timeline item -->--}}
          {{--<!-- timeline time label -->--}}
          {{--<li class="time-label">--}}
                      {{--<span class="bg-green">--}}
                        {{--3 Jan. 2014--}}
                      {{--</span>--}}
          {{--</li>--}}
          {{--<!-- /.timeline-label -->--}}
          {{--<!-- timeline item -->--}}
          {{--<li>--}}
            {{--<i class="fa fa-camera bg-purple"></i>--}}

            {{--<div class="timeline-item">--}}
              {{--<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>--}}

              {{--<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>--}}

              {{--<div class="timeline-body">--}}
                {{--<img src="http://placehold.it/150x100" alt="..." class="margin">--}}
                {{--<img src="http://placehold.it/150x100" alt="..." class="margin">--}}
                {{--<img src="http://placehold.it/150x100" alt="..." class="margin">--}}
                {{--<img src="http://placehold.it/150x100" alt="..." class="margin">--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<!-- END timeline item -->--}}
          {{--<li>--}}
            {{--<i class="fa fa-clock-o bg-gray"></i>--}}
          {{--</li>--}}
        </ul>
      </div>

    {{--</ul>--}}
  {{--</div>--}}

@endsection

