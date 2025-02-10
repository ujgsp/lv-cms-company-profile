<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $projects = Project::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $projects = $projects->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $projects = $projects->paginate(10)->withQueryString();

        return view('dashboard.projects.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create', [
            'categories' => Category::where('type', 'project')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:projects,slug',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required',
            'project_information' => 'required',
            'category_id' => 'required|array', // Pastikan input categories adalah array
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('project-images', 'public');
                $validatedData['thumbnail'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data project
            $project = Project::create([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'thumbnail' => $validatedData['thumbnail'],
                'body' => $validatedData['description'],
                'project_info' => $validatedData['project_information'],
            ]);

            // Attach categories to the project
            $project->categories()->attach($validatedData['category_id']);

            return redirect()->route('projects.index')->with('success', 'Project has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating project: ' . $th->getMessage());

            return redirect()->route('projects.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::where('type', 'project')->get();
        return view('dashboard.projects.edit', [
            'categories' => $categories,
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|unique:projects,slug,' . $project->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required',
            'project_information' => 'required',
            'categories' => 'required|array', // Pastikan input categories adalah array
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $project->thumbnail);

                $imagePath = $request->file('thumbnail')->store('project-images', 'public');
                $validatedData['thumbnail'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan thumbnail yang lama
                $validatedData['thumbnail'] = $project->thumbnail;
            }

            // Update data project
            $project->update([
                'title' => $validatedData['title'],
                'slug' => $validatedData['slug'],
                'thumbnail' => $validatedData['thumbnail'],
                'body' => $validatedData['description'],
                'project_info' => $validatedData['project_information'],
            ]);

            // Sync categories to the project
            $project->categories()->sync($validatedData['categories']);

            return redirect()->route('projects.index')->with('success', 'Project has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating project: ' . $th->getMessage());

            return redirect()->route('projects.index', $project->slug)->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $project->thumbnail);

            // Hapus entri service dari database
            $project->delete();

            return redirect()->route('projects.index')->with('success', 'Project has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting project: ' . $th->getMessage());

            return redirect()->route('projects.index')->withErrors([$th->getMessage()]);
        }
    }

    public function checkSlug(Request $request)
    {
        // Ambil slug dari request
        $slug = $request->input('slug');

        // Periksa apakah slug sudah digunakan sebelumnya
        $postWithSlug = Project::where('slug', $slug)->exists();

        // Kirim respons JSON berdasarkan keunikan slug
        return response()->json(['unique' => !$postWithSlug]);
    }
}
