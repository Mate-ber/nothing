<?php

namespace App\Http\Controllers;

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
}
