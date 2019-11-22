@extends('layouts.layout-admin')

@section('content')

    @include('admin.sub-menu', ['title' => __('poll.nav.research'), 'navslug' => 'research'])

    @foreach($researches as $research)

        <div style="padding: 5px 0;">
           <a href='/admin/research/{{ $research->id }}'>{{ $research->created_at }}</a>
           / 
           {{ $research->title }} 
           / 
           <a href="/admin/research/{{ $research->id }}/edit">Edit</a>
        </div>
    @endforeach

@endsection