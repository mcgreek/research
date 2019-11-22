@extends('layout-admin')

@section('content')
	
	<h1>Edit poll #{{ $poll->id }}</h1>

	<form method="POST" action="/admin/poll/{{ $poll->id }}">
		@method('PATCH')
		@csrf
		<div class="field">
			<label class="label">{{ __('poll.admin.research') }}</label>
			<div class="control">
			  <div class="select">
			    {!! Form::select('research_id', $researches, $poll->research_id); !!}
			  </div>
			</div>
		</div>

		@if ($poll->poll_parent_id)
			<div class="field">
				<label class="label">{{ __('poll.admin.poll-parent') }}</label>
				<div class="control"><a href="/admin/poll/{{ $poll->poll_parent_id }}">#{{ $poll->poll_parent_id }}</div>
			</div>
		@endif

		<div class="field">
		  <label class="label">{{ __('poll.admin.token') }}</label>
		  <div class="control">
		    <input class="input" type="text" name="token" value="{{ $poll->token }}" placeholder="{{ __('poll.admin.token') }}">
		  </div>
		  <p class="help">{{ __('poll.admin.token-help') }}</p>
		</div>

		<div class="field">
			<label class="checkbox">
				{{ __('poll.admin.create-pool-anonymous-title') }}
			  <input type="checkbox" name="is_anonymus" value="1" 
			  	@if ($poll->is_anonymus == '1')
			  		checked 
			  	@endif 
			   />
			</label>
		</div>

		<div class="field">
			<label class="checkbox">
				{{ __('poll.admin.create-pool-share-title') }}
			  <input type="checkbox" name="allow_sharing" value="1" 
			  	@if ($poll->allow_sharing == '1')
			  		checked 
			  	@endif
			    />
			</label>
		</div>

		<div class="control">
		  <button class="button is-primary">{{ __('poll.admin.update-button') }}</button>
		</div>

	</form>

@endsection