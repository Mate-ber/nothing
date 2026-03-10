<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class MyNothingController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        $payments = Payment::with('payable')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $totalAmount = $payments->sum('amount');

        return view('my-nothing.show', [
            'user' => $user,
            'payments' => $payments,
            'totalAmount' => $totalAmount,
        ]);
    }
}
