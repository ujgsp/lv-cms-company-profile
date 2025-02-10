<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardCounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $counters = Counter::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $counters = $counters->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $counters = $counters->paginate(10)->withQueryString();

        return view('dashboard.counters.index', [
            'counters' => $counters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.counters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'value' => 'required|string'
        ]);

        try {

            // Simpan data
            Counter::create([
                'title' => $validatedData['title'],
                'value' => $validatedData['value']
            ]);

            return redirect()->route('counters.index')->with('success', 'Counter has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating counter: ' . $th->getMessage());

            return redirect()->route('counters.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Counter $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Counter $counter)
    {
        return view('dashboard.counters.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counter $counter)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'value' => 'required|string'
        ]);

        try {

            // Simpan data
            $counter->update([
                'title' => $validatedData['title'],
                'value' => $validatedData['value']
            ]);

            return redirect()->route('counters.index')->with('success', 'Counter has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating counter: ' . $th->getMessage());

            return redirect()->route('counters.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counter $counter)
    {
        try {

            // Hapus entri data dari database
            $counter->delete();

            return redirect()->route('counters.index')->with('success', 'Counter has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting counter: ' . $th->getMessage());

            return redirect()->route('counters.index')->withErrors([$th->getMessage()]);
        }
    }
}
