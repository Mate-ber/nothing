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
                    <td>{{ \App\Support\Money::cents($certificate->price) }} $</td>
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
@endsection
