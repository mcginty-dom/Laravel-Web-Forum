@extends('layouts.app')

@section('title', 'Posts')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="jumbotron">
          <h1>Posts of Blogger</h1>
          <p><a class="btn btn-success btn-lg"
            href="{{ route('posts.create') }}" role="button">
            Create a Post </a></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <ul>
          @foreach ($posts as $post)

              <img src="{{ asset('images/' . $post->image) }}">
              <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                <h2>{{ $post->header }}</h2>
              </a>
              <h3>Posted by: {{$post->user->name}}</h3>
              <p><a class="btn btn-primary btn-lg"
                href="{{ route('posts.show', ['id' => $post->id]) }}"
                role="button"> Begin Reading </a></p>
          @endforeach
        </ul>
        <div class="text-center">
          {{ $posts->links() }}
      </div>
    </div>
  </div>
@endsection
