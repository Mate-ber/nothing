<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Services\PaymentCreator;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('id', 'desc')->get();

        return view('certificates.index', [
            'certificates' => $certificates,
        ]);
    }

    public function buy(Certificate $certificate)
    {
        return view('certificates.buy', [
            'certificate' => $certificate,
        ]);
    }

    public function purchase(Certificate $certificate, Request $request)
    {
        $request->validate([
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'digits_between:12,19'],
            'card_expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'card_cvc' => ['required', 'digits_between:3,4'],
        ]);

        $user = auth()->user();

        $creator = new PaymentCreator();

        $creator->create($user, $certificate, $certificate->price, 'test-certificate');

        return redirect()
            ->route('certificates.index')
            ->with('status', 'Certificate purchased (test payment)!');
    }

}
