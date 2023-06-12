@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
{!! Form::open(['url' => 'post/create']) !!}
    {!! Form::input('text', 'newPost', null,['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
    <button type="submit" class="btn btn-success pull-right">追加</button>
{!! Form::close() !!}

<br>
<br>
    @foreach ($posts as $post)
        {{ $post->id }}
        {{ $post->posts }}
        {{ $post->created_at }}

        {!! Form::open(['url' => 'post/update']) !!}
    {!! Form::input('text', 'upPost', $post->posts, ['required', 'class' => 'form-control']) !!}
    {!! Form::hidden( 'id', $post->id,) !!}
    <button type="submit" class="btn btn-success pull-right">編集</button>
{!! Form::close() !!}

            <a class="btn btn-danger" href="/post/{{ $post->id }}/delete">削除</a>
<br>
    @endforeach

@endsection
