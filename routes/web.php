<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\CertificateAdminController;
use App\Http\Controllers\Admin\NftAdminController;
use App\Http\Controllers\MyNothingController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\SubscriptionController;


Route::get('/subscriptions', [SubscriptionController::class, 'index'])
    ->name('subscriptions.index');
Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])
    ->name('subscriptions.show');

Route::view('/about-nothing', 'about-nothing')->name('about-nothing');


Route::middleware(['auth', 'admin.email'])->group(function () {
    Route::get('/admin/stats', [StatsController::class, 'index'])
        ->name('admin.stats.index');
    Route::get('/admin/nfts', [NftAdminController::class, 'index'])
        ->name('admin.nfts.index');
    Route::get('/admin/nfts/create', [NftAdminController::class, 'create'])
        ->name('admin.nfts.create');
    Route::post('/admin/nfts', [NftAdminController::class, 'store'])
        ->name('admin.nfts.store');
    Route::get('/admin/nfts/{nft}/edit', [NftAdminController::class, 'edit'])
        ->name('admin.nfts.edit');
    Route::put('/admin/nfts/{nft}', [NftAdminController::class, 'update'])
        ->name('admin.nfts.update');
    Route::delete('/admin/nfts/{nft}', [NftAdminController::class, 'destroy'])
        ->name('admin.nfts.destroy');

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
});

Route::middleware('auth')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');

    Route::get('/certificates/{certificate}/buy', [CertificateController::class, 'buy'])->name('certificates.buy');
    Route::post('/certificates/{certificate}/purchase', [CertificateController::class, 'purchase'])->name('certificates.purchase');

    Route::get('/nfts/{nft}/buy', [NftController::class, 'buy'])->name('nfts.buy');
    Route::post('/nfts/{nft}/purchase', [NftController::class, 'purchase'])->name('nfts.purchase');

    Route::get('/my-nothing', [MyNothingController::class, 'show'])->name('my-nothing.show');

    Route::post('/subscriptions/{subscription}/purchase', [SubscriptionController::class, 'purchase'])
        ->name('subscriptions.purchase');
});

Route::get('/certificates', [CertificateController::class, 'index'])
    ->name('certificates.index');

Route::get('/nfts', [NftController::class, 'index'])
    ->name('nfts.index');

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
