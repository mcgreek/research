@extends('layouts.layout-admin')

@section('content')

    @include('admin.sub-menu', ['title' => __('poll.nav.research'), 'navslug' => 'research'])

    <div class="content">
    	<div>{{ __('poll.admin.show-research-id', ['id' => $research->id]) }}</div>
    	<div>{{ __('poll.admin.show-research-title', ['title' => $research->title]) }}</div>
    	<div>{{ __('poll.admin.show-research-date', ['date' => $research->created_at]) }}</div>

    	<div><a href="/admin/research/{{ $research->id }}/edit">{{ __('poll.admin.edit-button') }}</a></div>
    </div>

    @if ($research->polls->count())
    <h2>Related polls</h2>
    <div class="content">
    	@foreach ($research->polls as $poll)
    		<div><a href="/admin/poll/{{ $poll->id }}">{{ $poll->id }} / {{ $poll->token }}</a></div>
    	@endforeach
    </div>
    @endif
@endsection
