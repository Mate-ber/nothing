<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nothing NFTs</title>
</head>
<body>
<h1>Nothing NFTs</h1>

@if ($nfts->isEmpty())
    <p>No NFTs yet.</p>
@else
    <ul>
        @foreach ($nfts as $nft)
            <a href="{{ route('nfts.buy', $nft) }}">Buy this NFT</a>
            <li>
                <strong>{{ $nft->name }}</strong><br>
                Blockchain ID: {{ $nft->blockchain_id ?? 'none' }}<br>
                Price: {{ number_format($nft->price / 100, 2) }} $
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
