<?php

namespace App\Http\Controllers;

use App\Post;
use Exception;
use App\Comment;
use App\Notifications\PostComment;
use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post_id = preg_replace("/[^\d]/", "", $request->post_id);
        return view('comment.create', compact('post_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $comment = new Comment($request->input());
            $comment->user_id = auth()->user()->id;
            $comment->save();
            $author = $comment->post->user;

            // Para notificar um comentário no posts
            // O processo de enviar pelo e-mail é demorado
            // Para isso vamos trabalhar com fila (Queues)
            // --------------------------------------------
            // BROADCAST_DRIVER=log
            // CACHE_DRIVER=file
            // QUEUE_CONNECTION=database (Vamos alterar para database)
            // SESSION_DRIVER=cookie
            // SESSION_LIFETIME=120 (minutos)
            // ---------------------------------------------
            // php artisan queue:table 
            // php artisan migrate
            // class PostComment extends Notification implements ShouldQueue
            // Fazer o implementação do implements ShouldQueue em notification
            // php artisan queue:work (Para executar QUEUE)

            $author->notify(new PostComment($comment));


            return redirect()->route('post.show',['post' => $comment->post_id])->withSuccess('We have successfully registered.');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->withError($ex->getMessage());
        }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Comment $comment)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        try {
            $comment->title = $request->title;
            $comment->body = $request->body;
            $comment->save();
            return redirect()->route('post.show',['post' => $comment->post_id])->withSuccess('We have successfully edited.');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->withError($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $this->authorize('comment-auth', $comment);
            $comment->delete();
            return redirect()->route('post.show',['post' => $comment->post_id])->withSuccess('We have successfully deleted.');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->withError($ex->getMessage());
        }
    }
}
