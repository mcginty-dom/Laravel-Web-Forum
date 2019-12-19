@extends('layouts.app')

@section('title', 'Edit a Comment')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Are you sure you want to delete this comment?</h1>
      <p>User {{$comment->user_id ?? 'Unknown'}} said: </p>
      <p>{{$comment->body ?? 'Unknown'}} </p>
      <form method="POST"
        action="{{ route('comments.destroy', ['id' => $comment->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Confirm</button>
      </form>
      <p><a href="{{ route('posts.index') }}"> Return </a></p>
    </div>
  </div>
@endsection
