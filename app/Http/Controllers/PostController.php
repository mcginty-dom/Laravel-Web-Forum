<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();
        return view('posts.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
          'header' => 'required|max:25',
          'body' => 'required|max:50',
          'user_id' => 'required|integer',
        ]);

        $a = new Post;
        $a->header =$validatedData['header'];
        $a->body =$validatedData['body'];
        $a->user_id =$validatedData['user_id'];
        $a->save();

        session()->flash('message', 'Your post was created.');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        if($post->user_id == auth()->user()->id) {
          return view('posts.edit', ['post' => $post]);
        } else {
          session()->flash('message',
          'This page belongs to another user, you cannot edit this.');
          return redirect()->route('posts.index');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
          'header' => 'required|max:25',
          'body' => 'required|max:50',
          'user_id' => 'required|integer',
        ]);
        $post = Post::findOrFail($id);
        //$post->title = $request->input('title');
        //$post->body = $request->input('body');
        $post->header=$validatedData['header'];
        $post->body =$validatedData['body'];
        $post->user_id =$validatedData['user_id'];
        $post->save();

        session()->flash('message', 'Your post was updated.');
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        if($post->user_id == auth()->user()->id) {
          $post->delete();
          return redirect()->route('posts.index')
            ->with('message', 'Your post was deleted.');
        } else {
          session()->flash('message',
          'This page belongs to another user, you cannot delete this.');
          return redirect()->route('posts.index');
        }
    }
}
