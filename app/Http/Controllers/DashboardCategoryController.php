<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardCategoryController extends Controller
{
    // --------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai query dan type dari request
        $filters = $request->only(['query', 'type']);

        // Terapkan filter menggunakan query scope
        $categories = Category::filter($filters)
            ->orderBy('type')
            ->paginate(10); // pagination

        return view('dashboard.categories.index', compact('categories'));
    }


    // --------------------------------------------------------------------

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
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
            'slug' => 'required|string|unique:categories,slug',
            'type' => 'required|string'
        ]);

        try {

            // Simpan data
            Category::create([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'type' => $validatedData['type']
            ]);

            return redirect()->route('categories.index')->with('success', 'Category has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating category: ' . $th->getMessage());

            return redirect()->route('categories.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    // --------------------------------------------------------------------

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    // --------------------------------------------------------------------

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:categories,slug, ' . $category->id,
            'type' => 'required|string'
        ]);

        try {

            // Simpan data
            $category->update([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'type' => $validatedData['type']
            ]);

            return redirect()->route('categories.index')->with('success', 'Category has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating category: ' . $th->getMessage());

            return redirect()->route('categories.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {

            // Hapus entri data dari database
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Category has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting category: ' . $th->getMessage());

            return redirect()->route('categories.index')->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    public function checkSlug(Request $request)
    {
        // Ambil slug dari request
        $slug = $request->input('slug');

        // Periksa apakah slug sudah digunakan sebelumnya
        $postWithSlug = Category::where('slug', $slug)->exists();

        // Kirim respons JSON berdasarkan keunikan slug
        return response()->json(['unique' => !$postWithSlug]);
    }

    // --------------------------------------------------------------------


    public function getCategoryOptions($type)
    {
        // $categories = Category::all();
        $categories = Category::where('type', $type)->get();

        return response()->json($categories);
    }


    // --------------------------------------------------------------------


    public function storeFromAjax(Request $request)
    {
        $request->validate([
            'titleCategory' => 'required|string',
            'slugCategory' => 'required|string|unique:categories,slug',
        ]);

        // Simpan data kategori baru
        $category = new Category();
        $category->title = $request->titleCategory;
        $category->slug = $request->slugCategory;
        $category->type = $request->typeCategory;
        $category->save();

        return response()->json(['success' => true]);
    }

    // --------------------------------------------------------------------
}
