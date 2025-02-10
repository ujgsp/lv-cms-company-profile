<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardSliderController extends Controller
{
    // --------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $sliders = Slider::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $sliders = $sliders->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $sliders = $sliders->paginate(10)->withQueryString();

        return view('dashboard.sliders.index', [
            'sliders' => $sliders
        ]);
    }

    // --------------------------------------------------------------------

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sliders.create');
    }

    // --------------------------------------------------------------------

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'text_primary' => 'required|string',
            'text_secondary' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'button_title' => 'required|string',
            'button_link' => 'required|string',
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('slider-images', 'public');
                $validatedData['thumbnail'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data
            Slider::create([
                'text_primary' => $validatedData['text_primary'],
                'text_secondary' => $validatedData['text_secondary'],
                'thumbnail' => $validatedData['thumbnail'],
                'btn_title' => $validatedData['button_title'],
                'btn_link' => $validatedData['button_link'],
            ]);

            return redirect()->route('sliders.index')->with('success', 'Slider has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating slider: ' . $th->getMessage());

            return redirect()->route('sliders.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    // --------------------------------------------------------------------

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact('slider'));
    }

    // --------------------------------------------------------------------

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        // Validasi input
        $validatedData = $request->validate([
            'text_primary' => 'required|string',
            'text_secondary' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'button_title' => 'required|string',
            'button_link' => 'required|string',
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $slider->thumbnail);

                $imagePath = $request->file('thumbnail')->store('slider-images', 'public');
                $validatedData['thumbnail'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan thumbnail yang lama
                $validatedData['thumbnail'] = $slider->thumbnail;
            }

            // Update data project
            $slider->update([
                'text_primary' => $validatedData['text_primary'],
                'text_secondary' => $validatedData['text_secondary'],
                'thumbnail' => $validatedData['thumbnail'],
                'btn_title' => $validatedData['button_title'],
                'btn_link' => $validatedData['button_link'],
            ]);

            return redirect()->route('sliders.index')->with('success', 'Slider has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating slider: ' . $th->getMessage());

            return redirect()->route('sliders.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $slider->thumbnail);

            // Hapus entri service dari database
            $slider->delete();

            return redirect()->route('sliders.index')->with('success', 'Slider has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting slider: ' . $th->getMessage());

            return redirect()->route('sliders.index')->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    public function toggleFeatured(Request $request)
    {
        $slider = Slider::find($request->id);

        if ($slider) {
            $slider->status = $request->status === 'enable' ? 'enable' : 'disable';
            $slider->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }


    // --------------------------------------------------------------------
}
