<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Payment;
use App\Models\User;
use App\Support\DemoUser;

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
        $user = DemoUser::get();

        Payment::create([
            'user_id' => $user->id,
            'amount' => $certificate->price,
            'payment_method' => 'test-certificate',
            'payable_id' => $certificate->id,
            'payable_type' => Certificate::class,
        ]);

        return redirect()
            ->route('certificates.index')
            ->with('status', 'Certificate purchased (test payment)!');
    }

}
