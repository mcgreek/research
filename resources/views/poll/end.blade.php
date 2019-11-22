@extends('layouts.layout-frontend')

@section('title')
{{ __('poll.end-title') }}
@endsection

@section('content')

    @if ($allow_sharing)
        @include('includes.share')
    @endif
@endsection