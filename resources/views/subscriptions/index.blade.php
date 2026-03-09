@extends('layouts.app', ['title' => 'Nothing Subscriptions'])

@section('content')
    <h1>Nothing Subscriptions</h1>

    @if ($subscriptions->isEmpty())
        <p>No subscriptions yet.</p>
    @else
        <ul>
            @foreach ($subscriptions as $subscription)
                <li>
                    <strong>{{ $subscription->name }}</strong><br>
                    {{ $subscription->description }}<br>
                    Price per month:
                    {{ \App\Support\Money::centsToDollars($subscription->price) }} $<br>
                    <a href="{{ route('subscriptions.show', $subscription) }}">View</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
