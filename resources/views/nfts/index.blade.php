@extends('layouts.app', ['title' => 'Nothing NFTs'])

@section('content')
    <h1>Nothing NFTs</h1>

    @if ($nfts->isEmpty())
        <p>No NFTs yet.</p>
    @else
        <ul>
            @foreach ($nfts as $nft)
                <li>
                    <strong>{{ $nft->name }}</strong><br>
                    Blockchain ID: {{ $nft->blockchain_id ?? 'none' }}<br>
                    Price: {{ number_format($nft->price / 100, 2) }} $<br>
                    <a href="{{ route('nfts.buy', $nft) }}">Buy this NFT</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
