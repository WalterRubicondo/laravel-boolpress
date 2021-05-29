@extends('layouts.app')

@section('content')
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('admin.index') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="row justify-content-center">
                    @foreach ($posts as $post)
                        <div class="col-md-3">
                            <div class="card">
                            <div class="card-header"><a href="{{route('posts.show', ['slug' => $post->slug])}}">{{$post->title}}</a></div>

                                <div class="card-body">
                                     {{$post->content}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection