@extends('layouts.app', ['title' => 'Nothing Donations'])

@section('content')
    <h1>Donations</h1>

    @if ($donations->isEmpty())
        <p>No donations yet.</p>
    @else
        <ul>
            @foreach ($donations as $donation)
                <li>
                    Donation #{{ $donation->id }} —
                    Campaign: {{ $donation->campaign_id ?? 'none' }} —
                    Amount: {{ number_format($donation->amount / 100, 2) }} $
                </li>
            @endforeach
        </ul>
    @endif
@endsection
