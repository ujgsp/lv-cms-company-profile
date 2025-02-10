<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $partners = Partner::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $partners = $partners->filter(request()->only(['query', 'status']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $partners = $partners->paginate(10)->withQueryString();
        return view('dashboard.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'nullable',
            'website' => 'nullable'
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('partner-images', 'public');
                $validatedData['image'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data
            Partner::create([
                'title' => $validatedData['title'],
                'image' => $validatedData['image'],
                'description' => $validatedData['description'],
                'website' => $validatedData['website']
            ]);

            return redirect()->route('partners.index')->with('success', 'Partner has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating partner: ' . $th->getMessage());

            return redirect()->route('partners.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('dashboard.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'nullable',
            'website' => 'nullable'
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $partner->image);

                $imagePath = $request->file('image')->store('partner-images', 'public');
                $validatedData['image'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['image'] = $partner->image;
            }

            // Update data project
            $partner->update([
                'title' => $validatedData['title'],
                'image' => $validatedData['image'],
                'description' => $validatedData['description'],
                'website' => $validatedData['website'],
                'status' => $request->status == 'publish' ? 'publish' : 'draft'
            ]);

            return redirect()->route('partners.index')->with('success', 'Partner has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating partner: ' . $th->getMessage());

            return redirect()->route('partners.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $partner->image);

            // Hapus entri service dari database
            $partner->delete();

            return redirect()->route('partners.index')->with('success', 'Partner has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting partner: ' . $th->getMessage());

            return redirect()->route('partners.index')->withErrors([$th->getMessage()]);
        }
    }
}
