@extends('layouts.app', ['title' => 'Edit NFT'])

@section('content')
    <h1>Edit NFT #{{ $nft->id }}</h1>

    <form method="POST" action="{{ route('admin.nfts.update', $nft) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <input
                id="name"
                name="name"
                value="{{ old('name', $nft->name) }}"
                required
            >
        </div>

        <div>
            <label for="blockchain_id">Blockchain ID (optional)</label>
            <input
                id="blockchain_id"
                name="blockchain_id"
                value="{{ old('blockchain_id', $nft->blockchain_id) }}"
            >
        </div>

        <div>
            <label for="price">Price (in dollars)</label>
            <input
                id="price"
                name="price"
                type="number"
                step="0.01"
                min="0"
                value="{{ old('price', \App\Support\Money::centsToDollars($nft->price)) }}"
                required
            >
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
