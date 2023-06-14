@extends('layouts.login')

@section('content')
<div>
  @foreach($followers as $follower)
  <a href="">
    <img src="/images/{{ $follower->images }}" alt="">
  </a>
  @endforeach
</div>

<table class='table table-hover'>
    <tr>
    @foreach ($follower_posts as $follower_post)
        <td>
          <img src="/images/{{ $follow_post->images }}" alt="">
        </td>
        <td>{{ $follower_post->username }}</td>
        <td>{{ $follower_post->posts }}</td>
        <td>{{ $follower_post->created_at }}</td>
    </tr>
    @endforeach
</table>
@endsection
