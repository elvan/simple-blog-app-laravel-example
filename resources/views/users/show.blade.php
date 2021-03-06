@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            @if ($user->image)
                <img src="{{ $user->image->url() }}" alt="user image" class="img-fluid img-thumbnail avatar rounded">
            @endif
        </div>

        <div class="col-8">
            <h3>{{ $user->name }}</h3>

            <p>Currently viewed by {{ $counter }} users</p>

            @auth
                @can('update', $user)
                    <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user]) }}">Edit profile</a>
                @endcan
            @endauth

            <x-comment-form :route="route('users.comments.store', ['user' => $user])"></x-comment-form>

            <h4>Comments</h4>
            <div>
                <x-comment-list :comments="$user->commentsOn"></x-comment-list>
            </div>
        </div>
    </div>
@endsection
