<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function index()
    {
        $user = User::where('email', 'demo@nothing.test')->firstOrFail();

        $payments = Payment::with('payable')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('payments.index', [
            'user' => $user,
            'payments' => $payments,
        ]);
    }
}
