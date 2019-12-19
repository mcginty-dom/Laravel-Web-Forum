@extends('layouts.app')

@section('title', 'Edit your Post')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="jumbotron">
          <h1>Edit your Post</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <h2>Header: <input type="text" name="header"
            value="{{ $post->header }}"></h2>
          <p>Body: <input type="text" name="body"
            value="{{ $post->body }}"></p>
            <h3>Posting as:
            <select name="user_id">
                <option value="{{ $post->user_id}}"
                  @if ($post->user_id == old('user_id'))
                    selected="selected"
                  @endif
                  >{{ $post->user->name }}</option>
            </select>
          </h3>
            <p>Upload an image:
              <input type="file" name="featured_image"
              value="{{ old('image')}}"> </p>
          <input type="submit" value="Submit">
          <p><a class="btn btn-primary btn-lg"
            href="{{ route('posts.show', ['id' => $post->id]) }}" role="button">
            Return </a></p>
        </form>
      </div>
    </div>
  </div>
@endsection
