@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

<div class='container'>
{{Form::open()}}

<div class='form-group'>
{{Form::text('posts',null,['class'=>'form-control','placeholder'=>'何をつぶやこうか'])}}
</div>

{{Form::button('投稿',['type' => 'submit','class' => 'btn btn-success'])}}
{{Form::close()}}
</div>

<table class='table table-hover'>
  @foreach($list as $list)
  <tr>
    <td>{{ $list->id }}</td>
    <td>{{ $list->posts }}</td>
    <td>{{ $list->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection
