<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use App\Models\Payment;
use App\Models\User;
use App\Support\DemoUser;

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
        $user = DemoUser::get();

        Payment::create([
            'user_id' => $user->id,
            'amount' => $nft->price,
            'payment_method' => 'test-nft',
            'payable_id' => $nft->id,
            'payable_type' => Nft::class,
        ]);

        return redirect()
            ->route('nfts.index')
            ->with('status', 'NFT purchased (test payment)!');
    }
}
