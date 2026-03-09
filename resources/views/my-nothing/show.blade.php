@extends('layouts.app', ['title' => 'My Nothing'])

@section('content')
    <h1>My Nothing</h1>

    <p>
        Hello, {{ $user->name }}.<br>
        You have spent {{ \App\Support\Money::centsToDollars($totalAmount) }} $ on Nothing so far.
    </p>

    @if ($payments->isEmpty())
        <p>You have not bought or donated to Nothing yet.</p>
    @else
        <h2>Recent Nothing activity</h2>
        <ul>
            @foreach ($payments as $payment)
                <li>
                    [{{ class_basename($payment->payable_type) }}]
                    {{ $payment->payment_method }} —
                    {{ \App\Support\Money::centsToDollars($payment->amount) }} $
                </li>
            @endforeach
        </ul>
    @endif
@endsection
