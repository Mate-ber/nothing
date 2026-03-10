<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Nothing' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a> |
        <a href="{{ route('certificates.index') }}">Certificates</a> |
        <a href="{{ route('nfts.index') }}">NFTs</a> |
        <a href="{{ route('donations.create') }}">Donate</a> |
        <a href="{{ route('payments.index') }}">Payments</a> |
        <a href="{{ route('my-nothing.show') }}">My Nothing</a> |
        <a href="{{ route('subscriptions.index') }}">Subscriptions</a> |
        <a href="{{ route('admin.stats.index') }}">Admin stats</a> |
        <a href="{{ route('about-nothing') }}">About</a>

        @auth
            <span>Hi, {{ auth()->user()->name }}</span> |
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a> |
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <hr>

    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    @yield('content')
</body>
</html>
