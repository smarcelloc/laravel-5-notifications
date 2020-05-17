<?php

namespace App\Http\Controllers;

use App\Post;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $post = new Post($request->input());
            $post->user_id = auth()->user()->id;
            $post->save();
            return redirect()->route('post.index')->withSuccess('We have successfully registered.');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->withError($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            return redirect()->route('post.index')->withSuccess('We have successfully edited.');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->withError($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $this->authorize('post-auth', $post);
            $post->delete();
            return redirect()->route('post.index')->withSuccess('We have successfully deleted.');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route('post.index')->withInput()->withError($ex->getMessage());
        }
    }
}
