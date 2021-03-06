@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in! </p>
                    <a href="{{route('admin.posts.index')}}">Go to Posts</a>
                    <a href="{{route('admin.categories.index')}}">Go to Categories</a>
                    <a href="{{route('admin.tags.index')}}">Go to Tags</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
