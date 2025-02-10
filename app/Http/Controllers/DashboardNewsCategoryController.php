<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardNewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()
        ->where('type', 'news'); // Tambahkan kondisi where type news

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $categories = $categories->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $categories = $categories->paginate(10)->withQueryString();

        return view('dashboard.news-categories.index', [
            'news_categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.news-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:categories,slug'
        ]);

        try {

            // Simpan data ke database
            Category::create([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'type' => 'news'
            ]);

            return redirect()->route('newsCategories.index')->with('success', 'News category has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating news category: ' . $th->getMessage());

            return redirect()->route('newsCategories.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $newsCategory)
    {
        return view('dashboard.news-categories.edit', [
            'category' => $newsCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $newsCategory)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,' . $newsCategory->id,
        ]);

        try {
            // Update data service
            $newsCategory->update([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
            ]);

            return redirect()->route('newsCategories.index')->with('success', 'News category has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating news category: ' . $th->getMessage());

            return redirect()->route('newsCategories.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $newsCategory)
    {
        try {
            // Hapus data dari database
            $newsCategory->delete();

            return redirect()->route('newsCategories.index')->with('success', 'News category has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting news category: ' . $th->getMessage());

            return redirect()->route('newsCategories.index')->withErrors([$th->getMessage()]);
        }
    }

    public function checkSlug(Request $request)
    {
        // Ambil slug dari request
        $slug = $request->input('slug');

        // Periksa apakah slug sudah digunakan sebelumnya
        $postWithSlug = Category::where('slug', $slug)->exists();

        // Kirim respons JSON berdasarkan keunikan slug
        return response()->json(['unique' => !$postWithSlug]);
    }
}
