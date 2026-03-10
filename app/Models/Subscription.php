<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_subscriptions')
            ->withPivot(['started_at', 'status'])
            ->withTimestamps();
    }
}
