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
        $user = $request->user();

        $already = $user->subscriptions()
            ->where('subscription_id', $subscription->id)
            ->wherePivot('status', 'active')
            ->exists();

        if ($already) {
            return redirect()
                ->route('subscriptions.show', $subscription)
                ->with('status', 'You already have this subscription active.');
        }

        $user->subscriptions()->attach($subscription->id, [
            'started_at' => now(),
            'status' => 'active',
        ]);

        $creator = new PaymentCreator();
        $creator->create($user, $subscription, $subscription->price, 'test-subscription');

        return redirect()
            ->route('subscriptions.index')
            ->with('status', 'Subscription started (test payment)!');
    }
}
