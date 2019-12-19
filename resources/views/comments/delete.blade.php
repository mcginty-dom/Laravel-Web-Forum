@extends('layouts.app')

@section('title', 'Confirm Deletion of Comment')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Are you sure you want to delete your comment?</h1>
        <p>{{Auth::user()->name ?? 'Unknown'}} said: </p>
        <p>{{$comment->body ?? 'Unknown'}} </p>
        <form method="POST"
          action="{{ route('comments.destroy', ['id' => $comment->id]) }}">
          @csrf
          @method('DELETE')
          <button type="submit">Confirm</button>
        </form>
        <p><a class="btn btn-primary btn-lg"
          href="{{ route('posts.show', ['id' => $comment->post_id]) }}" role="button">
          Return </a></p>
      </div>
    </div>
  </div>
@endsection
