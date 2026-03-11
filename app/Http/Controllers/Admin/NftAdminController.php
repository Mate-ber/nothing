<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nft;
use App\Support\Money;
use Illuminate\Http\Request;

class NftAdminController extends Controller
{
    public function index()
    {
        $nfts = Nft::orderBy('id')->get();
        $deletedNfts = Nft::onlyTrashed()->orderByDesc('id')->get();

        return view('admin.nfts.index', [
            'nfts' => $nfts,
            'deletedNfts' => $deletedNfts,
        ]);
    }

    public function create()
    {
        return view('admin.nfts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'blockchain_id' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $priceInCents = (int) round($validated['price'] * 100);

        Nft::create([
            'name' => $validated['name'],
            'blockchain_id' => $validated['blockchain_id'] ?? null,
            'price' => $priceInCents,
        ]);

        return redirect()
            ->route('admin.nfts.index')
            ->with('status', 'NFT created.');
    }

    public function edit(Nft $nft)
    {
        return view('admin.nfts.edit', [
            'nft' => $nft,
        ]);
    }

    public function update(Request $request, Nft $nft)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'blockchain_id' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $priceInCents = (int) round($validated['price'] * 100);

        $nft->update([
            'name' => $validated['name'],
            'blockchain_id' => $validated['blockchain_id'] ?? null,
            'price' => $priceInCents,
        ]);

        return redirect()
            ->route('admin.nfts.index')
            ->with('status', 'NFT updated.');
    }

    public function destroy(Nft $nft)
    {
        $nft->delete();

        return redirect()
            ->route('admin.nfts.index')
            ->with('status', 'NFT deleted.');
    }

    public function restore($nft)
    {
        $nft = Nft::onlyTrashed()->findOrFail($nft);
        $nft->restore();

        return redirect()
            ->route('admin.nfts.index')
            ->with('status', 'NFT restored.');
    }
}
