<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;

class NftController extends Controller
{
    public function index()
    {
        $nfts = Nft::orderBy('id', 'desc')->get();

        return view('nfts.index', [
            'nfts' => $nfts,
        ]);
    }
}
