<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\NftController;

Route::get('/certificates', [CertificateController::class, 'index'])
    ->name('certificates.index');

Route::get('/nfts', [NftController::class, 'index'])
    ->name('nfts.index');

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
