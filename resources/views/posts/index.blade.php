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

<div class="modalopen" data-target="modal{{ $post->id }}">
    <button type="submit" class="btn btn-success pull-right" >
        <img src="/storage/images/edit.png" >
    </button>
</div>

        <td>
            <a class="btn btn-danger" href="/post/{{ $post->id }}/delete" onclick="return confirm
            ('こちらの投稿を削除してもよろしいでしょうか？')">
                <img src="/storage/images/trash.png"
                onmouseover="this.src='/storage/images/trash_h.png'"
                onmouseout="this.src='/storage/images/trash.png'">
            </a>
        </td>

<div class="modal-main" id="modal{{ $post->id }}">
    <div class="modal-inner">
        <div class="inner-content">
            <div class="post-Form">
                {!! Form::open(['url' => 'post/update']) !!}
                    {!! Form::input('text', 'upPost', $post->posts,['required', 'class' => 'form-edit']) !!}
                    {!! Form::hidden( 'id', $post->id,) !!}
                    <button type="submit" class="btn btn-success pull-right" >
                        <img src="/storage/images/edit.png" class="image-modal">
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>




    @endif
<br>
@endforeach

@endsection
