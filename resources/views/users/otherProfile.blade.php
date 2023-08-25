@extends('layouts.login')

@section('content')
<div>
    <a href="">
        <img src="/storage/images/{{$user->images}}"
        class="icon-img">
        {{$user->username}}
        {{$user->bio}}
</a>
</div>
<table>
@if($followNumbers->contains($user->id))
<tr>
        <td class ='follow_delete_button'>
            <form action="/follow/delete" method="post">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id">
                <input type="submit" value="フォローを外す">
            </form>
        </td>
        @else
        <td class = 'follow_button'>
            <form action="/follow/create" method="post">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id">
                <input type="submit" value="フォローする">
            </form>
        </td>
        </tr>
        @endif
</table>


<table class='table table-hover'>
    <tr>
      @foreach($posts as $post)
      <td>
        <img src="/storage/images/{{ $post->images }}"
        alt="" class="icon-img">
      </td>
      <td>{{ $post->username }}</td>
      <td>{{ $post->posts }}</td>
      <td>{{ $post->created_at }}</td>
    </tr>
    @endforeach
</table>
@endsection
