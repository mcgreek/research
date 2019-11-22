@extends('layout')

@section('title')
    {{ __('poll.personal-data') }}
@endsection

@section('content')
    <form action="/poll/user" method="POST">
        @csrf

        {{ __('poll.email-title') }} <input type="text" name="email" />
        
        <div>
            <input type="submit" name="submit" value="{{ __('poll.email-button') }}" />
        </div>
    </form>
@endsection