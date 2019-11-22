@extends('layout')

@section('title')
    {{ $screen->title }}
@endsection

@section('content')
    <form action="/poll" method="POST">
        @csrf
        <input type="hidden" name="screen_id" value="{{ $currentScreenId }}" />

        @foreach($questions as $question)
        <div style="font-weight: 1000;">{{ $question->title }}</div>

            {!! $questionAnswers[$question->id]->toString() !!}
        @endforeach
        
        <div>
            <input type="submit" name="submit" value="{{ __('poll.submit-results') }}" />
        </div>
    </form>
@endsection