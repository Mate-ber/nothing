<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\PaymentCreator;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::orderBy('id')->get();

        return view('subscriptions.index', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', [
            'subscription' => $subscription,
        ]);
    }

    public function purchase(Subscription $subscription, Request $request)
    {
        $user = auth()->user();

        $creator = new PaymentCreator();

        $creator->create($user, $subscription, $subscription->price, 'test-subscription');

        return redirect()
            ->route('subscriptions.index')
            ->with('status', 'Subscription started (test payment)!');
    }
}
