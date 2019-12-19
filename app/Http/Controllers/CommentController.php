<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        //
        $validatedData = $request->validate([
          'body' => 'required|min:5:|max:50',
          'user_id' => 'required|integer',
          'post_id' => 'required|integer',
        ]);

        $user = $validatedData['user_id'];
        $post = Post::findOrFail($post_id);

        $comment = new Comment();
        $comment->body =$validatedData['body'];
        $comment->user_id =$validatedData['user_id'];
        $comment->post_id =$validatedData['post_id'];
        $comment->user()->associate($user);
        $comment->post()->associate($post);

        $comment->save();

        session()->flash('message', 'Your comment was created.');
        return redirect()->route('posts.show', ['id' => $comment->post_id]);
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
        $comment = Comment::findOrFail($id);
        if($comment->user_id == auth()->user()->id) {
          return view('comments.edit', ['comment' => $comment]);
        } else {
          session()->flash('message',
          'This comment belongs to another user, you cannot edit this.');
          return redirect()->route('posts.show', ['id' => $comment->post_id]);
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
          'body' => 'required|min:5:|max:50',
          'user_id' => 'required|integer',
          'post_id' => 'required|integer',
        ]);

        $comment = Comment::find($id);
        $comment->body =$validatedData['body'];
        $comment->user_id =$validatedData['user_id'];
        $comment->post_id =$validatedData['post_id'];

        $comment->save();

        session()->flash('message', 'Your comment was edited.');
        return redirect()->route('posts.show', ['id' => $comment->post_id]);
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
        $comment = Comment::findOrFail($id);
        if($comment->user_id == auth()->user()->id) {
          $comment->delete();
          return redirect()->route('posts.show', ['id' => $comment->post_id])
            ->with('message', 'Your comment was deleted.');
        } else {
          session()->flash('message',
          'This comment belongs to another user, you cannot delete this.');
          return redirect()->route('posts.show', ['id' => $comment->post_id]);
        }
    }

    public function delete($id)
    {
      $comment = Comment::findOrFail($id);
      if($comment->user_id == auth()->user()->id) {
        return view('comments.delete', ['comment' => $comment]);
      } else {
        session()->flash('message',
        'This comment belongs to another user, you cannot delete this.');
        return redirect()->route('posts.show', ['id' => $comment->post_id]);
      }
    }
}
