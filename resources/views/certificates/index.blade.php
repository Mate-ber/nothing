<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nothing Certificates</title>
</head>
<body>
<h1>Nothing Certificates</h1>

@if (session('status'))
    <p style="color: green;">{{ session('status') }}</p>
@endif

@if ($certificates->isEmpty())
    <p>No certificates yet.</p>
@else
    <ul>
        @foreach ($certificates as $certificate)
            <li>
                <strong>{{ $certificate->name }}</strong><br>
                {{ $certificate->description }}<br>
                Price: {{ number_format($certificate->price / 100, 2) }} $<br>
                <a href="{{ route('certificates.buy', $certificate) }}">Buy this certificate</a>
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
