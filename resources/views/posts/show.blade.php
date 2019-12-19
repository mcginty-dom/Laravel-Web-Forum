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

  <ul>
    <p> Total Comments: {{ $post->comments->count() }} </p>
    @foreach($post->comments as $comment)
      <p>User {{$comment->user_id ?? 'Unknown'}} said: </p>
      <p>{{$comment->body ?? 'Unknown'}} </p>
      <form method="POST"
        action="{{ route('comments.delete', ['id' => $comment->id]) }}">
        @csrf
        @method('GET')
        <button type="submit">Delete Comment</button>
      </form>
      <form method="POST"
        action="{{ route('comments.edit', ['id' => $comment->id]) }}">
        @csrf
        @method('GET')
        <button type="submit">Edit Comment</button>
      </form>
    @endforeach
  </ul>

  <form method="POST"
    action="{{ route('comments.store', [$post->id]) }}">
    @csrf
    <p>Type a comment: <input type="text" name="body"
      value="{{ old('body') }}"></p>
    <p>Commenting as:
      <select name="user_id">
          <option value="{{ Auth::id() }}"
            @if (Auth::id() == old('user_id'))
              selected="selected"
            @endif
            >{{ Auth::user()->name ?? 'Guest' }}</option>
      </select>
    </p>
    <p>Post ID:
      <select name="post_id">
          <option value="{{ $post->id}}"
            @if ($post->id == old('post_id'))
              selected="selected"
            @endif
            >{{ $post->id }}</option>
      </select>
    </p>
    <button type="submit">Submit Comment</button>
  </form>
  <p><a href="{{ route('posts.index') }}"> Return </a></p>
@endsection
