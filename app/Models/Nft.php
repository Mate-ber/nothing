<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'blockchain_id',
        'price',
    ];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
