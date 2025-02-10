<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Models\PricingFeature;
use Illuminate\Support\Facades\Log;

class DashboardPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tangkap kiriman nilai dari form pencarian
        $query = request()->input('query');

        $pricing = Pricing::with('pricingFeatures')
        ->when($query, function($queryBuilder) use ($query){
            return $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
        ->get();

        return view('dashboard.pricing.index', compact('pricing'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pricing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'currency' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|string',
            'features' => 'required|array|min:1', // Validate that features is an array and has at least one item
            'features.*' => 'required|string', // Validate each feature
        ]);

        try {
            // Simpan data ke table pricing
            $pricing = Pricing::create([
                'name' => $validatedData['title'],
                'price' => $validatedData['price'],
                'currency' => $validatedData['currency'],
                'duration' => $validatedData['quantity'],
            ]);

            // Simpan fitur-fitur  ke table pricingFeature
            foreach ($validatedData['features'] as $feature) {
                PricingFeature::create([
                    'pricing_package_id' => $pricing->id,
                    'feature' => $feature,
                ]);
            }

            return redirect()->route('pricings.index')->with('success', 'Pricing has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating pricing: ' . $th->getMessage());

            return redirect()->route('pricings.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pricing $pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pricing $pricing)
    {
        // Memuat fitur-fitur terkait dengan pricing
        $pricing->load('pricingFeatures');

        // Mengambil fitur dari model dan mengonversi ke array
        $features = $pricing->pricingFeatures->pluck('feature')->toArray();

        return view('dashboard.pricing.edit', compact('pricing', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pricing $pricing)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'currency' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|string',
            'features' => 'required|array|min:1', // Validate that features is an array and has at least one item
            'features.*' => 'required|string', // Validate each feature
        ]);

        try {
            // Update data service
            $pricing->update([
                'name' => $validatedData['title'],
                'price' => $validatedData['price'],
                'currency' => $validatedData['currency'],
                'duration' => $validatedData['quantity'],
            ]);

            // Hapus fitur lama
            $pricing->pricingFeatures()->delete();

            // Simpan fitur-fitur baru
            foreach ($validatedData['features'] as $feature) {
                PricingFeature::create([
                    'pricing_package_id' => $pricing->id,
                    'feature' => $feature,
                ]);
            }

            return redirect()->route('pricings.index')->with('success', 'Pricing has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating pricing: ' . $th->getMessage());

            return redirect()->route('pricings.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pricing $pricing)
    {
        try {
            $pricing->delete();
            return redirect()->route('pricings.index')->with('success', 'Pricing has been deleted successfully.');
        } catch (\Throwable $th) {
            Log::error('Error deleting pricing: ' . $th->getMessage());
            return redirect()->route('pricings.index')->withErrors([$th->getMessage()]);
        }
    }

    public function toggleFeatured(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pricing_packages,id',
            'is_featured' => 'required|boolean',
        ]);

        $pricing = Pricing::findOrFail($request->id);
        $pricing->featured = $request->is_featured;
        $pricing->save();

        return response()->json(['success' => true]);
    }
}
