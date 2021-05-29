@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>{{$post->title}}</h3>
        <p>Category: 
        @if ($post->category)
        {{$post->category->name}}
        @endif
        </p>
        <img src="{{asset($post->cover)}}" alt="{{$post->title}}">
        <p>{{$post->content}}</p>
      </div>
</div>
@endsection