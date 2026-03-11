<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $payments = Payment::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
        $payments->load('payable');

        $totalAmount = $payments->sum('amount');
        $paymentsCount = $payments->count();

        return view('payments.index', [
            'user' => $user,
            'payments' => $payments,
            'totalAmount' => $totalAmount,
            'paymentsCount' => $paymentsCount,
        ]);
    }
}
