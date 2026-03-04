@extends('layouts.app', ['title' => 'Nothing Certificates'])

@section('content')
    <h1>Nothing Certificates</h1>


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
@endsection
