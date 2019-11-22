@component('mail::message')

{{ __('poll.share-title') }}
<br />
{{ __('poll.share-description') }}

@component('mail::button', ['url' => $url])
{{ __('poll.share-button') }}
@endcomponent

{{ __('poll.share-thanks') }}<br />
{{ config('app.name') }}
@endcomponent
