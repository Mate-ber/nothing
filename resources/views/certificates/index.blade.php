<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nothing Certificates</title>
</head>
<body>
<h1>Nothing Certificates</h1>

@if ($certificates->isEmpty())
    <p>No certificates yet.</p>
@else
    <ul>
        @foreach ($certificates as $certificate)
            <li>
                <strong>{{ $certificate->name }}</strong><br>
                {{ $certificate->description }}<br>
                Price: {{ number_format($certificate->price / 100, 2) }} $
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
