@component('mail::message')

{{ $content }}

@component('mail::button', ['url' => 'http://tasks.gerardrey.2dam.iesebre.com'])
  Link directe al projecte!
@endcomponent

@endcomponent
