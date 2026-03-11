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
        $request->validate([
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'digits_between:12,19'],
            'card_expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'card_cvc' => ['required', 'digits_between:3,4'],
        ]);

        $user = $request->user();

        $existing = $user->subscriptions()
            ->where('subscription_id', $subscription->id)
            ->first();

        if ($existing && $existing->pivot->status === 'active') {
            return redirect()
                ->route('subscriptions.show', $subscription)
                ->with('status', 'You already have this subscription active.');
        }

        if ($existing) {
            $user->subscriptions()->updateExistingPivot($subscription->id, [
                'started_at' => now(),
                'status' => 'active',
            ]);
        } else {
            $user->subscriptions()->attach($subscription->id, [
                'started_at' => now(),
                'status' => 'active',
            ]);
        }

        $creator = new PaymentCreator();
        $creator->create($user, $subscription, $subscription->price, 'test-subscription');

        return redirect()
            ->route('subscriptions.index')
            ->with('status', 'Subscription started (test payment)!');
    }
}
