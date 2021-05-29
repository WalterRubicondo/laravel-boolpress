@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
         <a href="{{route('admin.categories.create')}}">New category</a>
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach ($categories as $category)
        <div class="col-md-3">
            <div class="card">

                <div class="card-body">
                  <a href="{{route('admin.categories.show', ['category' => $category->slug])}}">{{$category->name}}</a>
                  <a href="{{route('admin.categories.edit', ['category' => $category->id])}}">Edit</a>
                  <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="post">
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