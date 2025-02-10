<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardFaqController extends Controller
{
    // --------------------------------------------------------------------

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $faqs = Faq::where('title', 'like', "%{$query}%")
                ->with('category')
                ->paginate(10);
        } else {
            $faqs = Faq::with('category')->paginate(10);
        }

        return view('dashboard.faqs.index', compact('faqs'));
    }


    // --------------------------------------------------------------------

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'faq')->get();
        return view('dashboard.faqs.create', compact('categories'));
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
            'category_id' => 'required',
            'description' => 'required'
        ]);

        try {
            // Simpan data
            Faq::create([
                'category_id' => $validatedData['category_id'],
                'title' => $validatedData['title'],
                'body' => $validatedData['description']
            ]);

            return redirect()->route('faqs.index')->with('success', 'FAQ has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating faq: ' . $th->getMessage());

            return redirect()->route('faqs.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    // --------------------------------------------------------------------

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        $categories = Category::where('type', 'faq')->get();
        return view('dashboard.faqs.edit', compact('faq', 'categories'));
    }

    // --------------------------------------------------------------------

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required',
            'description' => 'required'
        ]);


        try {
            // Update data service
            $faq->update([
                'category_id' => $validatedData['category_id'],
                'title' => $validatedData['title'],
                'body' => $validatedData['description'],
                'status' => $request->status === 'enable' ? 'enable' : 'disable'
            ]);

            return redirect()->route('faqs.index')->with('success', 'FAQ has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating faq: ' . $th->getMessage());

            return redirect()->route('faqs.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            return redirect()->route('faqs.index')->with('success', 'FAQ has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error deleting faq: ' . $th->getMessage());

            return redirect()->route('faqs.index')->withErrors([$th->getMessage()]);
        }
    }

    // --------------------------------------------------------------------
}
