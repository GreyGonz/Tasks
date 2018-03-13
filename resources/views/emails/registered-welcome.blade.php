@component('mail::message')
  # Welcome {{ $user->name }}

  Welcome to the tasks application!

  Greatings,<br>
  {{ config('app.name') }}
@endcomponent
