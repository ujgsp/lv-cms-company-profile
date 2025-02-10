<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DashboardServiceController extends Controller
{
    private $pagination = 10;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['services'] = Service::all();
        // Kuery awal untuk mengambil data post berdasarkan filter
        $categories = Service::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $categories = $categories->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $data['services'] = $categories->paginate($this->pagination)->withQueryString();

        return view('dashboard.services.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:services,slug',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required',
            'excerpt' => 'required|string|max:255'
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('service-images', 'public');
                $validatedData['thumbnail'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data service
            $service = Service::create([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'image' => $validatedData['thumbnail'],
                'body' => $validatedData['description'],
                'excerpt' => $validatedData['excerpt']
            ]);

            return redirect()->route('services.index')->with('success', 'Service has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating service: ' . $th->getMessage());

            return redirect()->route('services.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $data['service'] = $service;
        return view('dashboard.services.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:services,slug,' . $service->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required',
            'excerpt' => 'required|string|max:255'
        ]);


        try {
            // Simpan gambar thumbnail ke penyimpanan jika ada perubahan thumbnail
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama dari penyimpanan
                Storage::delete('public/' . $service->image);

                // Simpan gambar baru ke penyimpanan
                $imagePath = $request->file('thumbnail')->store('public/service-images');
                $validatedData['image'] = str_replace('public/', '', $imagePath);
            }


            // Update data service
            $service->update([
                'title' => $validatedData['title'],
                'slug' => $request->slug,
                'image' => $validatedData['image'] ?? $service->image, // Gunakan thumbnail baru jika ada, jika tidak gunakan thumbnail yang ada sebelumnya
                'body' => $validatedData['description'], // Gunakan konten HTML yang sudah diperbarui atau asli
                'excerpt' => $validatedData['excerpt']
            ]);

            return redirect()->route('services.index')->with('success', 'Service has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating service: ' . $th->getMessage());

            return redirect()->route('services.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            // Hapus gambar dari penyimpanan
            Storage::delete('public/' . $service->image);

            // Hapus entri service dari database
            $service->delete();

            return redirect()->route('services.index')->with('success', 'Service has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting service: ' . $th->getMessage());

            return redirect()->route('services.index')->withErrors([$th->getMessage()]);
        }
    }


    public function checkSlug(Request $request)
    {
        // Ambil slug dari request
        $slug = $request->input('slug');

        // Periksa apakah slug sudah digunakan sebelumnya
        $postWithSlug = Service::where('slug', $slug)->exists();

        // Kirim respons JSON berdasarkan keunikan slug
        return response()->json(['unique' => !$postWithSlug]);
    }
}
