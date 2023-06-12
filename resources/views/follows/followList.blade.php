@extends('layouts.login')

@section('content')
<div>
  @foreach($follows as $follow)
  <a href="">
    <img src="/images/{{ $follow->images }}" alt="">
  </a>
  @endforeach
</div>

<table class='table table-hover'>
    <tr>
    @foreach ($follow_post as $follow_post)
        <td>
          <img src="/images/{{ $follow_post->images }}" alt="">
        </td>
        <td>{{ $follow_post->username }}</td>
        <td>{{ $follow_post->posts }}</td>
        <td>{{ $follow_post->created_at }}</td>
    </tr>
    @endforeach
</table>
@endsection
