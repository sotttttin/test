@extends('layouts.logout')

@section('content')

{!! Form::open() !!}<!--Formの開始タグ-->

<p>DAWNSNSへようこそ</p>

{{ Form::label('e-mail') }}　　　　　　　　　　　　　　　　<!--emailの欄を作成-->
{{ Form::text('mail',null,['class' => 'input']) }}　　　 <!--属性を記述 第一,第二,第三引数-->
{{ Form::label('password') }}                           <!--パスワード欄を作成-->
{{ Form::password('password',['class' => 'input']) }}   <!--属性を記述 第一,第二,第三引数-->

{{ Form::submit('ログイン') }}                           <!--ログインボタンを作成-->

<p><a href="/register">新規ユーザーの方はこちら</a></p>   <!--register.blade.phpに遷移-->

{!! Form::close() !!}

@endsection
