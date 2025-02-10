<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $news = News::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $news = $news->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $news = $news->paginate(10)->withQueryString();
        return view('dashboard.news.index', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.news.create', [
            'categories' => Category::where('type', 'news')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:projects,slug',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'content' => 'required',
            'tags' => 'required|string',
            'category_id' => 'required', // Pastikan input categories adalah array
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('news-images', 'public');
                $validatedData['thumbnail'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data project
            $project = News::create([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'thumbnail' => $validatedData['thumbnail'],
                'body' => $validatedData['content'],
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($request->content), 200, '...'),
                'tags' => $validatedData['tags'],
                'user_id' => auth()->user()->id,
                'category_id' => $validatedData['category_id'],
                'status' => $request->publish == 'on' ? 'publish' : 'draft'
            ]);

            return redirect()->route('news.index')->with('success', 'News has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating news: ' . $th->getMessage());

            return redirect()->route('news.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('dashboard.news.edit', [
            'news' => $news,
            'categories' => Category::where('type', 'news')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:projects,slug,' . $news->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'content' => 'required',
            'tags' => 'required|string',
            'category_id' => 'required', // Pastikan input categories adalah array
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $news->thumbnail);

                $imagePath = $request->file('thumbnail')->store('news-images', 'public');
                $validatedData['thumbnail'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan thumbnail yang lama
                $validatedData['thumbnail'] = $news->thumbnail;
            }

            // Update data project
            $news->update([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'thumbnail' => $validatedData['thumbnail'],
                'body' => $validatedData['content'],
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($request->content), 200, '...'),
                'tags' => $validatedData['tags'],
                'user_id' => auth()->user()->id,
                'category_id' => $validatedData['category_id'],
                'status' => $request->publish == 'on' ? 'publish' : 'draft'
            ]);

            return redirect()->route('news.index')->with('success', 'News has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating news: ' . $th->getMessage());

            return redirect()->route('news.index', $news->slug)->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $news->thumbnail);

            // Hapus entri service dari database
            $news->delete();

            return redirect()->route('news.index')->with('success', 'News has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting news: ' . $th->getMessage());

            return redirect()->route('news.index')->withErrors([$th->getMessage()]);
        }
    }

    public function checkSlug(Request $request)
    {
        // Ambil slug dari request
        $slug = $request->input('slug');

        // Periksa apakah slug sudah digunakan sebelumnya
        $postWithSlug = News::where('slug', $slug)->exists();

        // Kirim respons JSON berdasarkan keunikan slug
        return response()->json(['unique' => !$postWithSlug]);
    }
}
