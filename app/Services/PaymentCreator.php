<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PaymentCreator
{
    public function create(User $user, Model $payable, int $amount, string $method): Payment
    {
        return Payment::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'payment_method' => $method,
            'payable_id' => $payable->getKey(),
            'payable_type' => $payable::class,
        ]);
    }
}
