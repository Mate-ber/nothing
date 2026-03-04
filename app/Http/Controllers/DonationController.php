<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Support\DemoUser;
use App\Services\PaymentCreator;

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

        $user = DemoUser::get();

        $donation = Donation::create([
            'campaign_id' => $validated['campaign_id'] ?? null,
            'amount' => $amountInCents,
        ]);

        $creator = new PaymentCreator();

        $creator->create($user, $donation, $amountInCents, 'test-donation');

        return redirect()
            ->route('donations.create')
            ->with('status', 'Thank you for donating to Nothing!');
    }

    public function index()
    {
        $donations = Donation::orderBy('id', 'desc')->get();

        return view('donations.index', [
            'donations' => $donations,
        ]);
    }
}
