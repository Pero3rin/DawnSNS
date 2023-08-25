@extends('layouts.login')

@section('content')

@foreach ($posts as $post)
<div>
    <img src="storage/images/{{ $post->images }}" alt="" class="icon-img">
    {{ $post->username }}
    {{ $post->posts }}
    {{ $post->created_at }}
</div>

@endforeach

@endsection
