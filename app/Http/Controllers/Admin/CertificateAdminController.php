<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Support\Money;

class CertificateAdminController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('id')->get();
        $deletedCertificates = Certificate::onlyTrashed()->orderByDesc('id')->get();

        return view('admin.certificates.index', [
            'certificates' => $certificates,
            'deletedCertificates' => $deletedCertificates,
        ]);
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $priceInCents = (int) round($validated['price'] * 100);

        Certificate::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $priceInCents,
        ]);

        return redirect()
            ->route('admin.certificates.index')
            ->with('status', 'Certificate created.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', [
            'certificate' => $certificate,
        ]);
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $priceInCents = (int) round($validated['price'] * 100);

        $certificate->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $priceInCents,
        ]);

        return redirect()
            ->route('admin.certificates.index')
            ->with('status', 'Certificate updated.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('status', 'Certificate deleted.');
    }

    public function restore($certificate)
    {
        $certificate = Certificate::onlyTrashed()->findOrFail($certificate);
        $certificate->restore();

        return redirect()
            ->route('admin.certificates.index')
            ->with('status', 'Certificate restored.');
    }

    public function forceDelete($certificate)
    {
        $certificate = Certificate::onlyTrashed()->findOrFail($certificate);
        $certificate->forceDelete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('status', 'Certificate permanently deleted.');
    }
}
