<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLOGS | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css"
        integrity="sha384-qF/QmIAj5ZaYFAeQcrQ6bfVMAh4zZlrGwTPY7T/M+iTTLJqJBJjwwnsE5Y0mV7QK" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-primary border-bottom shadow-sm mb-3">
        <h5 class="my-0 mr-md-auto font-weight-normal">
            <a href="{{ route('home.index') }}" class="text-white">BLOGS</a>
        </h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-white" href="{{ route('home.index') }}">{{ __('Home') }}</a>
            <a class="p-2 text-white" href="{{ route('posts.index') }}">{{ __('All Posts') }}</a>
            <a class="p-2 text-white" href="{{ route('posts.create') }}">{{ __('Add New Post') }}</a>
            <a class="p-2 text-white" href="{{ route('home.contact') }}">{{ __('Contact') }}</a>
            @guest
                @if (Route::has('register'))
                    <a class="p-2 text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                <a class="p-2 text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
                <a class="p-2 text-white"
                    href="{{ route('users.show', ['user' => Auth::user()->id]) }}">{{ __('Profile') }}</a>
                <a class="p-2 text-white"
                    href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">{{ __('Edit Profile') }}</a>
                <a class="p-2 text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }} ({{ Auth::user()->name }})</a>
                <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </nav>
    </div>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
