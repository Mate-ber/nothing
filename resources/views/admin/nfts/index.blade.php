@extends('layouts.app', ['title' => 'Admin NFTs'])

@section('content')
    <h1>Admin: NFTs</h1>

    <p><a href="{{ route('admin.nfts.create') }}">Create new NFT</a></p>

    @if ($nfts->isEmpty())
        <p>No NFTs yet.</p>
    @else
        <table border="1" cellpadding="6">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Blockchain ID</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($nfts as $nft)
                <tr>
                    <td>{{ $nft->id }}</td>
                    <td>{{ $nft->name }}</td>
                    <td>{{ $nft->blockchain_id ?? 'none' }}</td>
                    <td>{{ \App\Support\Money::centsToDollars($nft->price) }} $</td>
                    <td>
                        <a href="{{ route('admin.nfts.edit', $nft) }}">Edit</a>
                        |
                        <form action="{{ route('admin.nfts.destroy', $nft) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this NFT?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if ($deletedNfts->isNotEmpty())
        <h2>Deleted NFTs</h2>
        <table border="1" cellpadding="6">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($deletedNfts as $nft)
                <tr>
                    <td>{{ $nft->id }}</td>
                    <td>{{ $nft->name }}</td>
                    <td>{{ $nft->deleted_at }}</td>
                    <td>
                        <form action="{{ route('admin.nfts.restore', $nft->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
