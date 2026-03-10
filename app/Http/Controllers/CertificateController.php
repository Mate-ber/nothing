<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Payment;
use App\Models\User;
use App\Services\PaymentCreator;

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

    public function purchase(Certificate $certificate)
    {
        $user = auth()->user();

        $creator = new PaymentCreator();

        $creator->create($user, $certificate, $certificate->price, 'test-certificate');

        return redirect()
            ->route('certificates.index')
            ->with('status', 'Certificate purchased (test payment)!');
    }

}
