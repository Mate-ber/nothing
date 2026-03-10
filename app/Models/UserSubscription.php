<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSubscription extends Pivot
{
    protected $table = 'user_subscriptions';

    protected $fillable = [
        'user_id',
        'subscription_id',
        'started_at',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
    ];
}
