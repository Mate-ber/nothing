<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaymentController;

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::get('/certificates', [CertificateController::class, 'index'])
    ->name('certificates.index');

Route::get('/nfts', [NftController::class, 'index'])
    ->name('nfts.index');

Route::get('/donations/create', [DonationController::class, 'create'])
    ->name('donations.create');
Route::post('/donations', [DonationController::class, 'store'])
    ->name('donations.store');

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
