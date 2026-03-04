@extends('layouts.app', ['title' => 'Nothing Payments'])

@section('content')
    <h1>Payments for {{ $user->name }}</h1>

    @if ($payments->isEmpty())
        <p>No payments yet.</p>
    @else
        <table border="1" cellpadding="6">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Method</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ class_basename($payment->payable_type) }}</td>
                    <td>
                        @if ($payment->payable)
                            @if ($payment->payable_type === \App\Models\Donation::class)
                                Donation #{{ $payment->payable->id }}
                            @elseif ($payment->payable_type === \App\Models\Certificate::class)
                                Certificate: {{ $payment->payable->name }}
                            @elseif ($payment->payable_type === \App\Models\Nft::class)
                                NFT: {{ $payment->payable->name }}
                            @else
                                #{{ $payment->payable->id }}
                            @endif
                        @else
                            (missing payable)
                        @endif
                    </td>
                    <td>{{ number_format($payment->amount / 100, 2) }} $</td>
                    <td>{{ $payment->payment_method }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
