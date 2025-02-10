<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class DashboardSubscriberController extends Controller
{
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $subscribers = subscriber::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $subscribers = $subscribers->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $subscribers = $subscribers->paginate(10)->withQueryString();

        return view('dashboard.subscribers.index',[
            'subscribers' => $subscribers
        ]);
    }

    public function destroy(Subscriber $subscriber)
    {
        \Illuminate\Support\Facades\Log::info('Destroy method called for subscriber id: ' . $subscriber->id);
        try {
            // Hapus entri data dari database
            $subscriber->delete();

            return redirect()->route('subscribers.index')->with('success', 'Subscriber has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting dashboard subscriber: ' . $th->getMessage());

            return redirect()->route('subscribers.index')->withErrors([$th->getMessage()]);
        }
    }
}
