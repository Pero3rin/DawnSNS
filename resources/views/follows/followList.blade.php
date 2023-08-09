@extends('layouts.login')

@section('content')
<div>
  @foreach($follows as $follow)
  <a href="/otherProfile/{{ $follow->id }}">
    <img src="storage/images/{{ $follow->images }}" alt=""
    class="icon-img">
  </a>
  @endforeach
</div>

<table class='table table-hover'>
    <tr>
    @foreach ($follow_posts as $follow_post)
        <td>
          <a href='/otherProfile/{{$follow->id}}'>
          <img src="storage/images/{{ $follow_post->images }}" alt=""
          class="icon-img">
</a>
        </td>
        <td>{{ $follow_post->username }}</td>
        <td>{{ $follow_post->posts }}</td>
        <td>{{ $follow_post->created_at }}</td>
    </tr>
    @endforeach
</table>
@endsection
