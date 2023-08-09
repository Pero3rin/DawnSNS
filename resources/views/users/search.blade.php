@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/search']) !!}
        <div class="form-group">
            {!! Form::input('text', 'search', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
        </div>

  <div class="menu-trigger">
  </div>

        <button type="submit" class="btn btn-success pull-right">検索</button>
        {!! Form::close() !!}

        <table class='search results'>
            <tr>
                <th>検索ワード:{{ $keyword }}
                </th>
            </tr>
        </table>

        <table class='table table-hover'>
            <tr>
                <th>ユーザー名</th>
            </tr>
                @foreach ($users as $user)
            <tr>
<td>
                <a href="/otherProfile/{{ $user->id }}">
    <img src="storage/images/{{ $user->images }}" alt=""
    class="icon-img">
  </a>

</td>

        <td>{{ $user->username }}</td>
            @if($followNumbers->contains($user->id))
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
        @endif
    </tr>
    @endforeach
</table>
@endsection
