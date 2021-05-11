<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Models\BlogPost;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function index(int $id)
    {
        $blogPost = BlogPost::with('comments')->findOrFail($id);

        return $blogPost->comments;
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        event(new CommentPosted($comment));

        return redirect()
            ->back()
            ->with('status', 'Comment was created!');
    }
}
