@extends('layouts.app', ['title' => 'Admin Subscriptions'])

@section('content')
    <h1>Admin: Subscriptions</h1>

    <p><a href="{{ route('admin.subscriptions.create') }}">Create new subscription</a></p>

    @if ($subscriptions->isEmpty())
        <p>No subscriptions yet.</p>
    @else
        <table border="1" cellpadding="6">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->name }}</td>
                    <td>{{ \App\Support\Money::centsToDollars($subscription->price) }} $</td>
                    <td>
                        <a href="{{ route('admin.subscriptions.edit', $subscription) }}">Edit</a>
                        |
                        <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this subscription?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if ($deletedSubscriptions->isNotEmpty())
        <h2>Deleted Subscriptions</h2>
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
            @foreach ($deletedSubscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->name }}</td>
                    <td>{{ $subscription->deleted_at }}</td>
                    <td>
                        <form action="{{ route('admin.subscriptions.restore', $subscription->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                        |
                        <form action="{{ route('admin.subscriptions.force-delete', $subscription->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Permanently delete this subscription? This cannot be undone.')">Permanently Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
