<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $members = Member::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $members = $members->filter(request()->only(['query', 'status']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $members = $members->paginate(10)->withQueryString();

        return view('dashboard.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'designation' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'linkedin' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('member-images', 'public');
                $validatedData['image'] = str_replace('public/', '', $imagePath);
            }

            // Simpan data
            Member::create([
                'name' => $validatedData['name'],
                'image' => $validatedData['image'],
                'designation' => $validatedData['designation'],
                'facebook_url' => $validatedData['facebook'],
                'twitter_url' => $validatedData['twitter'],
                'instagram_url' => $validatedData['instagram'],
                'linkedin_url' => $validatedData['linkedin'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone']
            ]);

            return redirect()->route('members.index')->with('success', 'Member has been created successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error creating member: ' . $th->getMessage());

            return redirect()->route('members.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('dashboard.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('dashboard.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'designation' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'linkedin' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        try {
            // Simpan gambar ke penyimpanan
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari penyimpanan
                \Illuminate\Support\Facades\Storage::delete('public/' . $member->image);

                $imagePath = $request->file('image')->store('project-images', 'public');
                $validatedData['image'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['image'] = $member->image;
            }

            // Update data project
            $member->update([
                'name' => $validatedData['name'],
                'image' => $validatedData['image'],
                'designation' => $validatedData['designation'],
                'facebook_url' => $validatedData['facebook'],
                'twitter_url' => $validatedData['twitter'],
                'instagram_url' => $validatedData['instagram'],
                'linkedin_url' => $validatedData['linkedin'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'status' => $request->status === 'enable' ? 'enable' : 'disable'
            ]);

            return redirect()->route('members.index')->with('success', 'Member has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error updating member: ' . $th->getMessage());

            return redirect()->route('members.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        try {
            // Hapus gambar dari penyimpanan
            \Illuminate\Support\Facades\Storage::delete('public/' . $member->image);

            // Hapus entri service dari database
            $member->delete();

            return redirect()->route('members.index')->with('success', 'Member has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting member: ' . $th->getMessage());

            return redirect()->route('members.index')->withErrors([$th->getMessage()]);
        }
    }
}
