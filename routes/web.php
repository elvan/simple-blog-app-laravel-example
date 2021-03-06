<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use App\Mail\CommentPostedMarkdown;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true,
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false,
    ],
    3 => [
        'title' => 'Intro to Vue',
        'content' => 'This is a short intro to Vue',
        'is_new' => true,
        'has_comments' => true,
    ],
    4 => [
        'title' => 'Intro to React',
        'content' => 'This is a short intro to React',
        'is_new' => false,
    ],
];

Route::resource('users', UserController::class)
    ->only(['show', 'edit', 'update']);

Route::resource('posts', PostController::class);

Route::resource('posts.comments', PostCommentController::class)
    ->only(['index', 'store']);

Route::resource('users.comments', UserCommentController::class)
    ->only(['store']);

Route::get('/posts/tag/{id}', [PostTagController::class, 'index'])
    ->name('posts.tags.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/secret', [HomeController::class, 'secret'])
    ->name('home.secret')
    ->middleware('can:home.secret');

Route::get('/single', AboutController::class)->name('home.single');

Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index');

Route::prefix('/fun')
    ->name('fun.')
    ->group(function () use ($posts) {
        Route::get('/responses', function () use ($posts) {
            return response($posts, 201)
                ->header('Content-Type', 'application/json')
                ->cookie('MY_COOKIE', 'Example User', 3600);
        })->name('responses');

        Route::get('/redirect', function () {
            return redirect('/contact');
        })->name('redirect');

        Route::get('/back', function () {
            return back();
        })->name('back');

        Route::get('/named-route', function () {
            return redirect()->route('posts.show', ['id' => 1]);
        })->name('named-route');

        Route::get('/away', function () {
            return redirect()->away('https://google.com');
        })->name('away');

        Route::get('/json', function () use ($posts) {
            return response()->json($posts);
        })->name('json');

        Route::get('/download', function () {
            return response()->download(public_path('/favicon.ico'));
        })->name('download');
    });


Route::get('mailable', function () {
    $comment = Comment::find(1);
    return new CommentPostedMarkdown($comment);
});

Auth::routes();
