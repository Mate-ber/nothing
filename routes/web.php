<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\CertificateAdminController;

Route::get('/admin/certificates', [CertificateAdminController::class, 'index'])
    ->name('admin.certificates.index');
Route::get('/admin/certificates/create', [CertificateAdminController::class, 'create'])
    ->name('admin.certificates.create');
Route::post('/admin/certificates', [CertificateAdminController::class, 'store'])
    ->name('admin.certificates.store');
Route::get('/admin/certificates/{certificate}/edit', [CertificateAdminController::class, 'edit'])
    ->name('admin.certificates.edit');
Route::put('/admin/certificates/{certificate}', [CertificateAdminController::class, 'update'])
    ->name('admin.certificates.update');
Route::delete('/admin/certificates/{certificate}', [CertificateAdminController::class, 'destroy'])
    ->name('admin.certificates.destroy');

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::get('/certificates', [CertificateController::class, 'index'])
    ->name('certificates.index');
Route::get('/certificates/{certificate}/buy', [CertificateController::class, 'buy'])
    ->name('certificates.buy');
Route::post('/certificates/{certificate}/purchase', [CertificateController::class, 'purchase'])
    ->name('certificates.purchase');

Route::get('/nfts', [NftController::class, 'index'])
    ->name('nfts.index');
Route::get('/nfts/{nft}/buy', [NftController::class, 'buy'])
    ->name('nfts.buy');
Route::post('/nfts/{nft}/purchase', [NftController::class, 'purchase'])
    ->name('nfts.purchase');

Route::get('/donations/create', [DonationController::class, 'create'])
    ->name('donations.create');
Route::get('/donations', [DonationController::class, 'index'])
    ->name('donations.index');
Route::post('/donations', [DonationController::class, 'store'])
    ->name('donations.store');


Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
