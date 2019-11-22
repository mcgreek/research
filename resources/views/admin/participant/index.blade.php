@extends('layouts.layout-admin')

@section('content')

    @foreach($participants as $participant)
        <div style="padding: 5px 0;">
           ID: {{ $participant->id }} 
           /
           {{ $participant->email }} 
           / 
           <a href="/admin/participant/{{ $participant->id }}">View polls</a>
           <br />
        </div>
    @endforeach

@endsection