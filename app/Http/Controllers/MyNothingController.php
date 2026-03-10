<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class MyNothingController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        $totalAmount = Payment::where('user_id', $user->id)->sum('amount');

        $payments = Payment::with('payable')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('my-nothing.show', [
            'user' => $user,
            'payments' => $payments,
            'totalAmount' => $totalAmount,
        ]);
    }
}
