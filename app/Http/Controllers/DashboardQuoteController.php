<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class DashboardQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $quotes = Quote::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $quotes = $quotes->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $quotes = $quotes->paginate(10)->withQueryString();

        return view('dashboard.quotes.index', [
            'quotes' => $quotes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        return view('dashboard.quotes.show', ['quote' => $quote]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        try {
            // Hapus entri service dari database
            $quote->delete();

            return redirect()->route('quotes.index')->with('success', 'Quote has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting dashboard quote: ' . $th->getMessage());

            return redirect()->route('quotes.index')->withErrors([$th->getMessage()]);
        }
    }
}
