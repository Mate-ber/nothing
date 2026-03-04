@extends('layouts.app', ['title' => 'Edit Certificate'])

@section('content')
    <h1>Edit Certificate #{{ $certificate->id }}</h1>

    <form method="POST" action="{{ route('admin.certificates.update', $certificate) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ old('name', $certificate->name) }}" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $certificate->description) }}</textarea>
        </div>

        <div>
            <label for="price">Price (in dollars)</label>
            <input id="price" name="price" type="number" step="0.01" min="0"
                   value="{{ old('price', \App\Support\Money::centsToDollars($certificate->price)) }}" required>
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
