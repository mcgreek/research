@extends('layouts.layout-admin')

@section('content')

    @include('admin.sub-menu', ['title' => __('poll.nav.research'), 'navslug' => 'research'])

<form action="/admin/research" method="post">
	@csrf
	<div class="field">
	  <label class="label">Research title</label>
	  <div class="control">
	    <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title" placeholder="Research title" value="{{ old('title') }}"  /> <!-- required // -->
	  </div>
	</div>
	<div class="control">
	  <button class="button is-primary">{{ __('poll.admin.create-button') }}</button>
	</div>

	@if ($errors->any())
		<div class="notification is-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
</form>
@endsection
