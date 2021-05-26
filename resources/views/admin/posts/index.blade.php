@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('admin.posts.create')}}">New post</a>
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach ($posts as $post)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><a href="{{route('admin.posts.show', ['post' => $post->slug])}}">{{$post->title}}</a></div>

                <div class="card-body">
                  {{$post->content}}

                  <div class="">
                    <a href="{{route('admin.posts.edit', ['post' => $post->id])}}">Edit</a>
                    <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="" value="Delete">
                    </form>
                  </div>
                </div>
            </div>
        </div>
      @endforeach
    </div>
</div>

@endsection