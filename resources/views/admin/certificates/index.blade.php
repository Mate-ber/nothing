@extends('layouts.app', ['title' => 'Admin Certificates'])

@section('content')
    <h1>Admin: Certificates</h1>

    <p><a href="{{ route('admin.certificates.create') }}">Create new certificate</a></p>

    @if ($certificates->isEmpty())
        <p>No certificates yet.</p>
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
            @foreach ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->id }}</td>
                    <td>{{ $certificate->name }}</td>
                    <td>{{ \App\Support\Money::centsToDollars($certificate->price) }} $</td>
                    <td>
                        <a href="{{ route('admin.certificates.edit', $certificate) }}">Edit</a>
                        |
                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this certificate?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if ($deletedCertificates->isNotEmpty())
        <h2>Deleted Certificates</h2>
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
            @foreach ($deletedCertificates as $certificate)
                <tr>
                    <td>{{ $certificate->id }}</td>
                    <td>{{ $certificate->name }}</td>
                    <td>{{ $certificate->deleted_at }}</td>
                    <td>
                        <form action="{{ route('admin.certificates.restore', $certificate->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                        |
                        <form action="{{ route('admin.certificates.force-delete', $certificate->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Permanently delete this certificate? This cannot be undone.')">Permanently Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
