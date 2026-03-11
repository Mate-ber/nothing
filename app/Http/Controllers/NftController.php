<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use App\Services\PaymentCreator;
use Illuminate\Http\Request;

class NftController extends Controller
{
    public function index()
    {
        $nfts = Nft::orderBy('id', 'desc')->get();

        return view('nfts.index', [
            'nfts' => $nfts,
        ]);
    }
    public function buy(Nft $nft)
    {
        return view('nfts.buy', [
            'nft' => $nft,
        ]);
    }

    public function purchase(Nft $nft, Request $request)
    {
        $request->validate([
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'digits_between:12,19'],
            'card_expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'card_cvc' => ['required', 'digits_between:3,4'],
        ]);

        $user = auth()->user();

        $creator = new PaymentCreator();

        $creator->create($user, $nft, $nft->price, 'test-nft');

        return redirect()
            ->route('nfts.index')
            ->with('status', 'NFT purchased (test payment)!');
    }
}
