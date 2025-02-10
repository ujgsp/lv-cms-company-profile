<?php

namespace App\Http\Controllers;

use App\Models\Usps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardUspsController extends Controller
{
    // --------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $usps = Usps::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $usps = $usps->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $usps = $usps->paginate(10)->withQueryString();

        return view('dashboard.usps.index', compact('usps'));
    }

    // --------------------------------------------------------------------

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.usps.create');
    }

    // --------------------------------------------------------------------

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required|string|max:255',
        ], ['image.required' => 'The thumbnail field is required.',]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('usps-images', 'public');
                $validatedData['image'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data
            Usps::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image' => $validatedData['image'],
            ]);

            return redirect()->route('usps.index')->with('success', 'Usps has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating usps: ' . $th->getMessage());

            return redirect()->route('usps.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Display the specified resource.
     */
    public function show(Usps $usps)
    {
        //
    }

    // --------------------------------------------------------------------

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usps $usp)
    {
        return view('dashboard.usps.edit', compact('usp'));
    }

    // --------------------------------------------------------------------

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usps $usp)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required|string|max:255',
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $usp->image);

                $imagePath = $request->file('image')->store('usps-images', 'public');
                $validatedData['image'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['image'] = $usp->image;
            }

            // Update data project
            $usp->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image' => $validatedData['image'],
            ]);

            return redirect()->route('usps.index')->with('success', 'Usps has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating usps: ' . $th->getMessage());

            return redirect()->route('usps.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usps $usp)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $usp->image);

            // Hapus entri service dari database
            $usp->delete();

            return redirect()->route('usps.index')->with('success', 'Usps has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting usps: ' . $th->getMessage());

            return redirect()->route('usps.index')->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------
}
