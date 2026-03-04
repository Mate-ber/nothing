<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Support\DemoUser;

class PaymentController extends Controller
{
    public function index()
    {
        $user = DemoUser::get();

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
