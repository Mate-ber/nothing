<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $payments = Payment::with('payable')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

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
