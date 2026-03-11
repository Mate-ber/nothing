@extends('layouts.app', ['title' => 'Buy Certificate'])

@section('content')
    <h1>Buy "{{ $certificate->name }}"</h1>

    <p>
        {{ $certificate->description }}<br>
        Price: {{ \App\Support\Money::centsToDollars($certificate->price) }} $
    </p>

    <form method="POST" action="{{ route('certificates.purchase', $certificate) }}">
        @csrf

        <div>
            <label for="card_name">Card Holder Name</label>
            <input type="text" id="card_name" name="card_name" value="{{ old('card_name') }}" required>
            @error('card_name')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="card_number">Card Number</label>
            <input type="text" id="card_number" name="card_number" inputmode="numeric" maxlength="19" value="{{ old('card_number') }}" required>
            @error('card_number')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="card_expiry">Expiry (MM/YY)</label>
            <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/YY" maxlength="5" value="{{ old('card_expiry') }}" required>
            @error('card_expiry')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="card_cvc">CVC</label>
            <input type="text" id="card_cvc" name="card_cvc" inputmode="numeric" maxlength="4" value="{{ old('card_cvc') }}" required>
            @error('card_cvc')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <p>This is a test payment. No real money is charged.</p>

        <button type="submit">Confirm test purchase</button>
    </form>
@endsection
