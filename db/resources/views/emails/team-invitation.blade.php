@component('mail::message')
{{ __('Vous avez été invité(e) à rejoindre l\'équipe :team !', ['team' => $invitation->team->name]) }}

@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
{{ __('Si vous n\'avez pas de compte, vous pouvez en créer un en cliquant sur le bouton ci-dessous. Après avoir créé un compte, vous pourrez cliquer sur le bouton d\'acceptation de l\'invitation dans cet e-mail pour accepter l\'invitation dans l\'équipe :') }}

@component('mail::button', ['url' => route('register')])
{{ __('Créer un compte') }}
@endcomponent

{{ __('Si vous avez déjà un compte, vous pouvez accepter cette invitation en cliquant sur le bouton ci-dessous :') }}

@else
{{ __('Vous pouvez accepter cette invitation en cliquant sur le bouton ci-dessous :') }}
@endif

@component('mail::button', ['url' => $acceptUrl])
{{ __('Accepter l\'invitation') }}
@endcomponent

{{ __('Si vous ne vous attendiez pas à recevoir une invitation pour rejoindre cette équipe, vous pouvez ignorer cet e-mail.') }}
@endcomponent
