<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

</style>

<p>Hi {{ $comment->commentable->user->name }}</p>

<p>
    Someone has commented on your blog post
    <a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
        {{ $comment->commentable->title }}
    </a>
</p>

<hr>

<img src="{{ $message->embed(storage_path('app/public') . '/' . $comment->user->image->path) }}" alt="image">

<p>
    <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
        {{ $comment->user->name }}
    </a> said:
</p>

<p>
    "{{ $comment->content }}"
</p>
