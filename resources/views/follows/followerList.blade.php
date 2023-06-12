@extends('layouts.login')

@section('content')
<div>
  @foreach($followers as $follower)
  <a href="">
    <img src="/images/{{ $follower->images }}" alt="">
  </a>
  @endforeach
</div>
@endsection
