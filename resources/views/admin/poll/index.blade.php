@extends('layouts.layout-admin')

@section('content')
    @include('admin.sub-menu', ['title' => __('poll.nav.poll'), 'navslug' => 'poll'])

    @foreach($polls as $poll)

        @php ($research = $researches[$poll->research_id])

        <div style="padding: 5px 0;">
           <a href='/admin/poll/{{ $poll->id }}'>{{ $poll->created_at }}</a>
           / 
           {{ $research->title }} 
           / 
           {{ $poll->is_anonymus ? 'Anonymus' : 'Registration' }}
           /
           {{ $poll->allow_sharing ? 'Can share' : 'Can\'t share' }}
           /
           <a href="/admin/poll/{{ $poll->id }}/edit">Edit</a>
           |
           <a href="/admin/poll/{{ $poll->id }}" class="delete-poll">Delete</a>
           <br />
           URL: {{ url('/poll/token/' . $poll->token) }}
        </div>
    @endforeach

    <script type="text/javascript">
      
      $(".delete-poll").click(function(e){
          e.preventDefault();

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax(
          {
              url: $(this).attr('href'),
              type: 'delete', // replaced from put
              dataType: "JSON",
              data: {
              },
              success: function (response)
              {
                  window.location.href = "/admin/poll";
              },
              error: function(xhr) {
               alert(xhr.responseText); // this line will save you tons of hours while debugging
              // do something here because of error
             }
          });
      });

    </script>

@endsection