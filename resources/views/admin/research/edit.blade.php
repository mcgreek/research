@extends('layouts.layout-admin')

@section('content')

    @include('admin.sub-menu', ['title' => __('poll.nav.research'), 'navslug' => 'research'])

	<h1>Edit research #{{ $research->id }}</h1>

	<form method="POST" action="/admin/research/{{ $research->id }}">
		@method('PATCH')
		@csrf
		<div class="field">
		  <label class="label">{{ __('poll.admin.research') }}</label>
		  <div class="control">
		    <input class="input" type="text" name="title" value="{{ $research->title }}" placeholder="{{ __('poll.admin.research') }}">
		  </div>
		</div>

		<div class="control">
		  <button class="button is-primary">{{ __('poll.admin.update-button') }}</button>
		</div>

	</form>
@endsection
