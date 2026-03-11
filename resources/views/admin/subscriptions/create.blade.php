@extends('layouts.app', ['title' => 'Create Subscription'])

@section('content')
    <h1>Create Subscription</h1>

    <form method="POST" action="{{ route('admin.subscriptions.store') }}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" required>

            @error('name')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>

            @error('description')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="price">Price per month (in dollars)</label>
            <input id="price" name="price" type="number" step="0.01" min="0"
                   value="{{ old('price', '10.00') }}" required>

            @error('price')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
