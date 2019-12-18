@extends('layouts.app')

@section('title', 'Posts')

@section('content')
  <p>The posts of Blogger:</p>
  <ul>
    @foreach ($posts as $post)
      <li>
        <a href="{{ route('posts.show', ['id' => $post->id]) }}">
          {{ $post->header }}
        </a>
        Posted by {{$post->user->name}}
      </li>
    @endforeach
  </ul>
  <a href="{{ route('posts.create') }}">Create a Post</a>
@endsection
