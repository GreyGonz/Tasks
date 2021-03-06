@extends('adminlte::layouts.app') 

@section('htmlheader_title')
    Tasks
@endsection


@section('main-content')

<div class="box box-info">
<div class="box-header ui-sortable-handle" style="cursor: move;">
   <i class="fa fa-envelope"></i>
   <h3 class="box-title">Quick Email</h3>
</div>
<div class="box-body">
   <form action="/send_mail" method="POST" id="send-mail-form">
      {{ csrf_field() }}
      <div class="form-group">
         <input type="email" class="form-control" name="emailto" placeholder="Email to:">
      </div>
      <div class="form-group">
         <input type="text" class="form-control" name="subject" placeholder="Subject">
      </div>
      <div>
        <textarea class="textarea form-control" name="message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;" placeholder="Message"></textarea>
      </div>
   </form>
</div>
<div class="box-footer clearfix">
   <button type="submit" form="send-mail-form" class="pull-right btn btn-default" id="sendEmail">Send</button>
</div>
</div>

@endsection