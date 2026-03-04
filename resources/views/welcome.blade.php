@extends('layouts.app', ['title' => 'Nothing'])

@section('content')
    <h1>Nothing</h1>

    <p>
        Buy the Nothing certificate, buy the Nothing NFT (internal), or donate to Nothing.
    </p>

    <ul>
        <li><a href="{{ route('certificates.index') }}">Buy Nothing certificate</a></li>
        <li><a href="{{ route('nfts.index') }}">Browse Nothing NFTs</a></li>
        <li><a href="{{ route('donations.create') }}">Donate to Nothing</a></li>
        <li><a href="{{ route('payments.index') }}">View demo payments</a></li>
    </ul>
@endsection
