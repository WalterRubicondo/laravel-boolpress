@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
         <a href="{{route('admin.tags.create')}}">New tag</a>
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach ($tags as $tag)
        <div class="col-md-3">
            <div class="card">

                <div class="card-body">
                  <a href="{{route('admin.tags.show', ['tag' => $tag->slug])}}">{{$tag->name}}</a>
                  <a href="{{route('admin.tags.edit', ['tag' => $tag->id])}}">Edit</a>
                  <form action="{{route('admin.tags.destroy', ['tag' => $tag->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="" value="Delete">
                    </form>
                </div>
            </div>
        </div>
      @endforeach
    </div>
</div>

@endsection