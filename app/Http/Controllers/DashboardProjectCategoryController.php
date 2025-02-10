<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardProjectCategoryController extends Controller
{
    private $pagination = 10;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()
        ->where('type', 'project'); // Tambahkan kondisi where type news

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $categories = $categories->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $categories = $categories->paginate($this->pagination)->withQueryString();

        return view('dashboard.project-categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project-categories.create');
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
                'type' => 'project'
            ]);

            return redirect()->route('projectCategories.index')->with('success', 'Project category has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating project category: ' . $th->getMessage());

            return redirect()->route('projectCategories.index')->withInput($request->all())->withErrors([$th->getMessage()]);
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
    public function edit(Category $projectCategory)
    {
        return view('dashboard.project-categories.edit', [
            'category' => $projectCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $projectCategory)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string'
        ]);

        // Periksa apakah slug berubah
        if ($request->slug != $projectCategory->slug) {
            $request->validate([
                'slug' => 'required|string|unique:categories,slug',
            ]);
        }

        try {
            // Update data service
            $projectCategory->update([
                'title' => $validatedData['title'],
                'slug' => $request->slug,
            ]);

            return redirect()->route('projectCategories.index')->with('success', 'Project category has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating project category: ' . $th->getMessage());

            return redirect()->route('projectCategories.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $projectCategory)
    {
        try {
            // Hapus data dari database
            $projectCategory->delete();

            return redirect()->route('projectCategories.index')->with('success', 'Project category has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting project category: ' . $th->getMessage());

            return redirect()->route('projectCategories.index')->withErrors([$th->getMessage()]);
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
