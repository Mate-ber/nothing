<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Payment;

class Nft extends Model
{
    use HasFactory, SoftDeletes;

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
