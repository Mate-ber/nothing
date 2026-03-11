<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionAdminController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::orderBy('id')->get();
        $deletedSubscriptions = Subscription::onlyTrashed()->orderByDesc('id')->get();

        return view('admin.subscriptions.index', [
            'subscriptions' => $subscriptions,
            'deletedSubscriptions' => $deletedSubscriptions,
        ]);
    }

    public function create()
    {
        return view('admin.subscriptions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $priceInCents = (int) round($validated['price'] * 100);

        Subscription::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $priceInCents,
        ]);

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('status', 'Subscription created.');
    }

    public function edit(Subscription $subscription)
    {
        return view('admin.subscriptions.edit', [
            'subscription' => $subscription,
        ]);
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $priceInCents = (int) round($validated['price'] * 100);

        $subscription->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $priceInCents,
        ]);

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('status', 'Subscription updated.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('status', 'Subscription deleted.');
    }

    public function restore($subscription)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($subscription);
        $subscription->restore();

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('status', 'Subscription restored.');
    }

    public function forceDelete($subscription)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($subscription);
        $subscription->forceDelete();

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('status', 'Subscription permanently deleted.');
    }
}
