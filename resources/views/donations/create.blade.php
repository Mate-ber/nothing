@extends('layouts.app', ['title' => 'Donate to Nothing'])

@section('content')
    <h1>Donate to Nothing</h1>

    <p><a href="{{ route('donations.index') }}">View all donations</a></p>

    <form method="POST" action="{{ route('donations.store') }}">
        @csrf

        <div>
            <label for="campaign_id">Campaign</label>
            <input type="text" id="campaign_id" name="campaign_id" value="{{ old('campaign_id', 'nothing-general') }}">

            @error('campaign_id')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="amount">Amount (in dollars)</label>
            <input type="number" id="amount" name="amount" min="1" step="0.01" required value="{{ old('amount', '5.00') }}">

            @error('amount')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Donate</button>
    </form>
@endsection
