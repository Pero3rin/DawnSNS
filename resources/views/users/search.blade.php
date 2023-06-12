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

        <table class='table table-hover'>
            <tr>
                <th>ユーザー名</th>
                <th>画像</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->images }}</td>
                @if($followNumbers->contains($user->id))
                <td>
                    <form action="/follow/delete" method="post">
                        @csrf
                        <input type="hidden" value="{{$user->id}}" name="id">
                        <input type="submit" value="フォローを外す">
                    </form>
                </td>
                @else
                <td>
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
