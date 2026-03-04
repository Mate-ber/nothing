<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Nothing' }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a> |
        <a href="{{ route('certificates.index') }}">Certificates</a> |
        <a href="{{ route('nfts.index') }}">NFTs</a> |
        <a href="{{ route('donations.create') }}">Donate</a> |
        <a href="{{ route('payments.index') }}">Payments</a>
    </nav>

    <hr>

    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    @yield('content')
</body>
</html>
