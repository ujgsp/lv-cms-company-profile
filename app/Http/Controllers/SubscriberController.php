<?php

namespace App\Http\Controllers;

use App\Models\subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255'
        ]);

        try {

            // Simpan data
            subscriber::create($validatedData);

            return back();
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating frontend subscribe us: ' . $th->getMessage());

            // return redirect()->route('testimonials.index')->withInput($request->all())->withErrors([$th->getMessage()]);
            // return back()->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }
}
