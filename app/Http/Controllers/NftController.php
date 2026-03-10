<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use App\Models\Payment;
use App\Models\User;
use App\Services\PaymentCreator;

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

    public function purchase(Nft $nft)
    {
        $user = auth()->user();

        $creator = new PaymentCreator();

        $creator->create($user, $nft, $nft->price, 'test-nft');

        return redirect()
            ->route('nfts.index')
            ->with('status', 'NFT purchased (test payment)!');
    }
}
