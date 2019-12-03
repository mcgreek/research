@extends('layouts.layout-admin')

@section('content')
<div class="content">
    <div>{{ __('poll.admin.show-research-title', ['title' => $poll->research->title]) }}</div>
    <div>{{ __('poll.admin.show-research-date', ['date' => $poll->research->created_at]) }}</div> 
    <br />
    <a href="/admin/poll/{{ $poll->id }}/edit">Edit</a>
    <br />
    {{ __('poll.admin.show-pool-details-title') }}<br />
    
    <form action="/admin/poll/share" method="post">
        {{ __('poll.admin.show-url-text') }}
        <div style="padding:5px; margin: 5px; border: 1px solid blue;">
            {{ $poll->getUrl() }}
        </div>
        
        <div>{{ __('poll.admin.show-alt-text') }}</div>
        
        {{ __('poll.admin.show-share-text') }}<br />
        <textarea name='emails' style='width: 400px; height: 200px;'></textarea>
        
        <div class="control">   
            <input class="button  is-primary" type="submit" name="btn" value="{{ __('poll.admin.show-share-button') }}" />
        </div>
    </form>
</div>

@endsection