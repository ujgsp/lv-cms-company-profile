<?php

namespace App\Http\Controllers;

use App\Models\ExternalLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardExternalLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $external_links = ExternalLink::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $external_links = $external_links->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $external_links = $external_links->paginate(10)->withQueryString();

        return view('dashboard.external_links.index', [
            'external_links' => $external_links
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.external_links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'location' => 'required',
            'placement' => 'required|string|in:both,header,footer',
            'newTab' => 'nullable|string',
        ]);

        try {

            // Simpan data
            ExternalLink::create([
                'title' => $validatedData['title'],
                'location' => $validatedData['location'],
                'placement' => $validatedData['placement'],
                'new_tab' => $request->input('newTab')  == 'true' ? true : false,
            ]);

            return redirect()->route('links.index')->with('success', 'Header / Footer Links has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating Header / Footer Links: ' . $th->getMessage());

            return redirect()->route('links.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ExternalLink $externalLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExternalLink $link)
    {
        return view('dashboard.external_links.edit', [
            'link' => $link
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExternalLink $link)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required',
            'placement' => 'required|string|in:both,header,footer',
            'newTab' => 'nullable|string',
        ]);

        try {

            // Simpan data
            $link->update([
                'title' => $validatedData['title'],
                'location' => $validatedData['location'],
                'placement' => $validatedData['placement'],
                'new_tab' => $request->input('newTab')  == 'true' ? true : false,
            ]);

            return redirect()->route('links.index')->with('success', 'Header / Footer Links has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating Header / Footer Links: ' . $th->getMessage());

            return redirect()->route('links.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExternalLink $link)
    {
        try {

            // Hapus entri data dari database
            $link->delete();

            return redirect()->route('links.index')->with('success', 'Header / Footer has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting Header / Footer: ' . $th->getMessage());

            return redirect()->route('links.index')->withErrors([$th->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:external_links,id',
            'status' => 'required|string',
        ]);

        $pricing = ExternalLink::findOrFail($request->id);
        $pricing->status = $request->status;
        $pricing->save();

        return response()->json(['success' => true]);
    }
}
