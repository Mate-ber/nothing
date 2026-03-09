@extends('layouts.app', ['title' => 'Admin Stats'])

@section('content')
    <h1>Admin Stats</h1>

    <ul>
        <li>Total payments: {{ $totalPayments }}</li>
        <li>Total amount: {{ \App\Support\Money::centsToDollars($totalAmount) }} $</li>
        <li>Certificates sold: {{ $certificatesSold }}</li>
        <li>NFTs sold: {{ $nftsSold }}</li>
        <li>Subscriptions started: {{ $subscriptionsStarted }}</li>
        <li>Total donations: {{ $donationsCount }}</li>
    </ul>
@endsection
