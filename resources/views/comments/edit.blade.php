@extends('layouts.app')

@section('title', 'Edit a Comment')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Edit comment</h1>
      <form method="POST" action="{{ route('comments.update', $comment->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <p>Body: <input type="text" name="body"
          value="{{ old('body') }}"></p>
        <p>User ID:
          <select name="user_id">
              <option value="{{ Auth::id() }}"
                @if (Auth::id() == old('user_id'))
                  selected="selected"
                @endif
                >{{ Auth::id() }}</option>
          </select>
        </p>
        <p>Post ID:
          <select name="post_id">
              <option value="{{ $comment->post_id }}"
                @if ($comment->post_id == old('post_id'))
                  selected="selected"
                @endif
                >{{ $comment->post_id }}</option>
          </select>
        </p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}"> Return </a>
      </form>
    </div>
  </div>
@endsection
