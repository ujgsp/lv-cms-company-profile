<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $testimonials = Testimonial::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $testimonials = $testimonials->filter(request()->only(['query', 'status']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $testimonials = $testimonials->paginate(10)->withQueryString();

        return view('dashboard.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'designation' => 'required',
            'organization' => 'nullable',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('testimonial-images', 'public');
                $validatedData['image'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data
            Testimonial::create([
                'name' => $validatedData['name'],
                'designation' => $validatedData['designation'],
                'organization' => $validatedData['organization'],
                'description' => $validatedData['description'],
                'image' => $validatedData['image'],
            ]);

            return redirect()->route('testimonials.index')->with('success', 'Testimonial has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating testimonial: ' . $th->getMessage());

            return redirect()->route('testimonials.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'designation' => 'required',
            'organization' => 'nullable',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $testimonial->image);

                $imagePath = $request->file('image')->store('testimonial-images', 'public');
                $validatedData['image'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['image'] = $testimonial->image;
            }

            // Update data project
            $testimonial->update([
                'name' => $validatedData['name'],
                'designation' => $validatedData['designation'],
                'organization' => $validatedData['organization'],
                'description' => $validatedData['description'],
                'image' => $validatedData['image'],
                'status' => $request->status === 'enable' ? 'enable' : 'disable'
            ]);

            return redirect()->route('testimonials.index')->with('success', 'Testimonial has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating testimonial: ' . $th->getMessage());

            return redirect()->route('testimonials.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $testimonial->image);

            // Hapus entri service dari database
            $testimonial->delete();

            return redirect()->route('testimonials.index')->with('success', 'Testimonial has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting testimonial: ' . $th->getMessage());

            return redirect()->route('testimonials.index')->withErrors([$th->getMessage()]);
        }
    }
}
