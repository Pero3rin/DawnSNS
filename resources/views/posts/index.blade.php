@extends('layouts.login')

@section('content')
{!! Form::open(['url' => 'post/create']) !!}
    {!! Form::input('text', 'newPost', null,['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか？']) !!}
    <button type="submit" class="btn btn-success pull-right">
        <img src="/storage/images/post.png">
    </button>
{!! Form::close() !!}

<br>
<br>
@foreach ($posts as $post)
    <img src="storage/images/{{ $post->images }}" alt="" class="icon-img">
    {{ $post->username }}
    {{ $post->posts }}
    {{ $post->created_at }}

    @if ($post->user_id === Auth::user()->id)


    <button type="submit" class="btn btn-success pull-right" >
        <img src="/storage/images/edit.png">
    </button>
        <a class="btn btn-danger" href="/post/{{ $post->id }}/delete">
                <img src="/storage/images/trash.png"
                onmouseover="this.src='/storage/images/trash_h.png'"
                onmouseout="this.src='/storage/images/trash.png'">
        </a>

<div class="modal-main">
    <div class="modal-inner">
            {!! Form::open(['url' => 'post/update']) !!}
            {!! Form::input('text', 'upPost', $post->posts,['required',   'class' => 'form-control']) !!}
            {!! Form::hidden( 'id', $post->id,) !!}
            {!! Form::close() !!}

            <button type="submit" class="btn btn-success pull-right" >
            <img src="/storage/images/edit.png">
        </button>
    </div>
</div>


    @endif
<br>
@endforeach

@endsection
