<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Donation;
use App\Models\Nft;
use App\Models\Payment;
use App\Models\Subscription;

class StatsController extends Controller
{
    public function index()
    {
        $totalPayments = Payment::count();
        $totalAmount = Payment::sum('amount');

        $certificatesSold = Payment::where('payable_type', Certificate::class)->count();
        $nftsSold = Payment::where('payable_type', Nft::class)->count();
        $subscriptionsStarted = Payment::where('payable_type', Subscription::class)->count();
        $donationsCount = Donation::count();

        return view('admin.stats.index', [
            'totalPayments' => $totalPayments,
            'totalAmount' => $totalAmount,
            'certificatesSold' => $certificatesSold,
            'nftsSold' => $nftsSold,
            'subscriptionsStarted' => $subscriptionsStarted,
            'donationsCount' => $donationsCount,
        ]);
    }
}
