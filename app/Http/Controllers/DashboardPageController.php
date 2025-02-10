<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $pages = Page::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $pages = $pages->filter(request()->only(['query', 'location']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $pages = $pages->paginate(10)->withQueryString();

        $data['pages'] = $pages;
        return view('dashboard.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:pages,slug',
            'body' => 'required',
            'location' => 'required'
        ]);

        try {

            // Simpan data
            Page::create([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
                'status' => $request->status == 'publish' ? 'publish' : 'draft',
            ]);

            return redirect()->route('pages.index')->with('success', 'Page has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating page: ' . $th->getMessage());

            return redirect()->route('pages.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('dashboard.pages.edit', [
            'page' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:pages,slug, '. $page->id,
            'body' => 'required',
            'location' => 'required'
        ]);

        try {

            // Simpan data
            $page->update([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'body' => $validatedData['body'],
                'location' => $validatedData['location'],
                'status' => $request->status == 'publish' ? 'publish' : 'draft',
            ]);

            return redirect()->route('pages.index')->with('success', 'Page has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating page: ' . $th->getMessage());

            return redirect()->route('pages.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        try {

            // Hapus entri data dari database
            $page->delete();

            return redirect()->route('pages.index')->with('success', 'Page has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting page: ' . $th->getMessage());

            return redirect()->route('pages.index')->withErrors([$th->getMessage()]);
        }
    }

    public function checkSlug(Request $request)
    {
        // Ambil slug dari request
        $slug = $request->input('slug');

        // Periksa apakah slug sudah digunakan sebelumnya
        $postWithSlug = Page::where('slug', $slug)->exists();

        // Kirim respons JSON berdasarkan keunikan slug
        return response()->json(['unique' => !$postWithSlug]);
    }
}
