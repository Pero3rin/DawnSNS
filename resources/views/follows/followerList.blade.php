@extends('layouts.login')

@section('content')
<div>
  @foreach($followers as $follower)
  <a href="/otherProfile/{{$follower->id}}">
    <img src="storage/images/{{ $follower->images }}" alt=""
    class="icon-img">
  </a>
  @endforeach
</div>

<table class='table table-hover'>
    <tr>
    @foreach ($follower_posts as $follower_post)
        <td>
          <a href='/otherProfile/{{$follower->id}}'>
          <img src="storage/images/{{ $follower_post->images }}" alt="" class="icon-img">
          </a>
        </td>
        <td>{{ $follower_post->username }}</td>
        <td>{{ $follower_post->posts }}</td>
        <td>{{ $follower_post->created_at }}</td>
    </tr>
    @endforeach
</table>
@endsection
