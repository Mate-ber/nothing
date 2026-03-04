@extends('layouts.app', ['title' => 'Buy NFT'])

@section('content')
    <h1>Buy "{{ $nft->name }}"</h1>

    <p>
        Blockchain ID: {{ $nft->blockchain_id ?? 'none' }}<br>
        Price: {{ \App\Support\Money::centsToDollars($certificate->price) }} $
    </p>

    <form method="POST" action="{{ route('nfts.purchase', $nft) }}">
        @csrf

        <p>This is a test payment. No real money is charged.</p>

        <button type="submit">Confirm test purchase</button>
    </form>
@endsection
