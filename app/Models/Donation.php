<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'amount',
    ];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
