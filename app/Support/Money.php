<?php

namespace App\Support;

class Money
{
    public static function centsToDollars(int $cents): string
    {
        return number_format($cents / 100, 2);
    }
}
