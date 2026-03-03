<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $amountInCents = (int) round($validated['amount'] * 100);

        Donation::create([
            'campaign_id' => $validated['campaign_id'] ?? null,
            'amount' => $amountInCents,
        ]);

        return redirect()
            ->route('donations.create')
            ->with('status', 'Thank you for donating to Nothing!');
    }
}
