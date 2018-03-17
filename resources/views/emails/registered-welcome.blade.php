@component('mail::message')
  # Welcome {{ $user_name }}

  Welcome to the tasks application!

  Greatings,<br>
  {{ config('app.name') }}
@endcomponent
