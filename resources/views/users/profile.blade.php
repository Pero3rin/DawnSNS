@extends('layouts.login')

@section('content')

<div>
<img src="/storage/images/{{ Auth::user()->images }}"
      class="icon-img">
</div>

{{ $users->username }}

<h2></h2>

{{Form::open(['url' => '/profile/update', 'files' => true])}}

{{ Form::label('UserName') }}
{{ Form::text('UserName',$users->username,['class' => 'input']) }}
@if($errors->has('username'))
<p>{{ $errors->first('username') }}</p>
@endif

<h2></h2>
{{ Form::label('MailAdress') }}
{{ Form::text('mail',$users->mail,['class' => 'input']) }}
@if($errors->has('mail'))
<p>{{ $errors->first('mail') }}</p>
@endif

<h2></h2>
{{ Form::label('PassWord') }}
{{ Form::text('password',$session_count,[ 'class' => 'input','readonly']) }}
@if($errors->has('password'))
<p>{{ $errors->first('password') }}</p>
@endif

<h2></h2>
{{ Form::label('NewPassWord') }}
{{ Form::text('NewPassword',null,['class' => 'input']) }}
@if($errors->has('password_'))
<p>{{ $errors->first('newpassword') }}</p>
@endif

<h2></h2>
{{ Form::label('bio') }}
{{ Form::text('bio',$users->bio,['class' => 'input']) }}
@if($errors->has('password_'))
<p>{{ $errors->first('bio') }}</p>
@endif

<h2></h2>
{{ Form::label('IconImage') }}
{{ Form::file('IconImage',null,['class' => 'input']) }}
@if($errors->has('IconImage'))
<p>{{ $errors->first('IconImage') }}</p>
@endif

<h2></h2>
{{ Form::submit('更新') }}

{{Form::close()}}

@endsection
