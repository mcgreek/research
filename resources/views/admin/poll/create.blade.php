@extends('layout-admin')

@section('content')
<div><b>{{ __('poll.admin.create-pool-title') }}</b></div>
<form action="/admin/poll" method="post">
    @csrf
    <select name="research_id">
        <option value="">{{ __('poll.admin.create-pool-dd-default-text') }}</option>
        @foreach ($researches as $id => $title)
            <option value="{{ $id }}">{{ $title }}</option>
        @endforeach
    </select>
    
    <div>{{ __('poll.admin.create-pool-anonymous-title') }} <input type="checkbox" name="is_anonymus" value="1" /></div>
    <div>{{ __('poll.admin.create-pool-share-title') }} <input type="checkbox" name="allow_sharing" value="1" /></div>
<br />
<input type="submit" name="btn" value="Create" />
</form>
@endsection
