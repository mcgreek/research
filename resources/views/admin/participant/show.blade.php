@extends('layouts.layout-admin')

@section('content')
<div class="content">
    <h2>Participant details</h2>
    <div>ID: {{ $participant->id }}</div>
    <div>Email: {{ $participant->email }}</div>
    <br />
    @if ($participantPolls->count())
        <h2>{{ __('poll.admin.show-participant-poll-title', ['count' => $participantPolls->count()]) }}</h2>
        <br />
        @foreach($participantPolls as $participantPoll)
            <div style="padding: 5px 0;">
               Started: {{ $participantPoll->created_at }} 
               /
               @if ($participantPoll->completed == '1')
                Completed
               @else
                UNCOMPLETED
               @endif
               /
               ID: {{ $participantPoll->poll->id }} 
               /
               <a href="/admin/poll/{{ $participantPoll->poll->id }}">View poll</a>
               <br />
            </div>
        @endforeach
    @endif
</div>

@endsection