@extends('layouts.app', ['title' => 'Buy Certificate'])

@section('content')
    <h1>Buy "{{ $certificate->name }}"</h1>

    <p>
        {{ $certificate->description }}<br>
        Price: {{ number_format($certificate->price / 100, 2) }} $
    </p>

    <form method="POST" action="{{ route('certificates.purchase', $certificate) }}">
        @csrf

        <p>This is a test payment. No real money is charged.</p>

        <button type="submit">Confirm test purchase</button>
    </form>
@endsection
