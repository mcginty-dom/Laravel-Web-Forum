@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
  <ul>
    <img src="{{ asset('images/' . $post->image) }}">
    <li>Header: {{ $post-> header ?? 'Unknown'}} </li>
    <li>Body: {{ $post-> body ?? 'Unknown'}} </li>
    <li>Created by: {{ $post-> user-> name}} </li>
  </ul>

  <form method="POST"
    action="{{ route('posts.destroy', ['id' => $post->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Post</button>
  </form>
  <form method="POST"
    action="{{ route('posts.edit', ['id' => $post->id]) }}">
    @csrf
    @method('GET')
    <button type="submit">Edit Post</button>
  </form>
  <p><a href="{{ route('posts.index') }}"> Return </a></p>
@endsection
