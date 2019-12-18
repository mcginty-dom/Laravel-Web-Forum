@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
  <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <p>Header: <input type="text" name="header"
      value="{{ old('header') }}"></p>
    <p>Body: <input type="text" name="body"
      value="{{ old('body') }}"></p>
    <p>User ID:
    <select name="user_id">
        <option value="{{ $user->id}}"
          @if ($user->id == old('user_id'))
            selected="selected"
          @endif
          >{{ $user->name }}</option>
    </select>
    </p>
    <p>Upload an image:
      <input type="file" name="featured_image"
      value="{{ old('image')}}"> </p>
    <input type="submit" value="Submit">
    <a href="{{ route('posts.index') }}"> Return </a>
  </form>
@endsection
