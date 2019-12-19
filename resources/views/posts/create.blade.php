@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Create a Post</h1>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
          @csrf
          <h2>Header: <input type="text" name="header"
            value="{{ old('header') }}"></h2>
          <p>Body: <input type="text" name="body"
            value="{{ old('body') }}"></p>
          <h3>Posting as:
          <select name="user_id">
              <option value="{{ $user->id}}"
                @if ($user->id == old('user_id'))
                  selected="selected"
                @endif
                >{{ $user->name }}</option>
          </select>
          </h3>
          <p>Upload an image:
            <input type="file" name="featured_image"
            value="{{ old('image')}}"> </p>
          <input type="submit" value="Submit">
          <p><a class="btn btn-primary btn-lg"
            href="{{ route('posts.index') }}" role="button">
            Return </a></p>
        </form>
      </div>
    </div>
  </div>
@endsection
