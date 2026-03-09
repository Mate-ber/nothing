@extends('layouts.app', ['title' => 'Nothing Subscription'])

@section('content')
    <h1>{{ $subscription->name }}</h1>

    <p>
        {{ $subscription->description }}<br>
        Price per month:
        {{ \App\Support\Money::centsToDollars($subscription->price) }} $
    </p>

    <form method="POST" action="{{ route('subscriptions.purchase', $subscription) }}">
        @csrf
        <p>This is a one-time test payment representing starting the subscription.</p>
        <button type="submit">Start Nothing subscription</button>
    </form>
@endsection
