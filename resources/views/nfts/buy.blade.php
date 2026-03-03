<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy NFT</title>
</head>
<body>
<h1>Buy "{{ $nft->name }}"</h1>

<p>
    Blockchain ID: {{ $nft->blockchain_id ?? 'none' }}<br>
    Price: {{ number_format($nft->price / 100, 2) }} $
</p>

<form method="POST" action="{{ route('nfts.purchase', $nft) }}">
    @csrf
    <p>This is a test payment. No real money is charged.</p>
    <button type="submit">Confirm test purchase</button>
</form>
</body>
</html>
