<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardCacheController extends Controller
{
    public function destroy()
    {
        Cache::flush(); // Menghapus semua cache
        return redirect()->route('dashboard.index')->with('success', 'Cache destroyed successfully.');
    }
}
