<?php

namespace App\Support;

use App\Models\User;

class DemoUser
{
    public static function get(): User
    {
        return User::where('email', 'demo@nothing.test')->firstOrFail();
    }
}
