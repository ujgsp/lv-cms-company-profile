<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardContactController extends Controller
{
    public function index()
    {
        // Kuery awal untuk mengambil data post berdasarkan filter
        $contacts = Contact::query();

        // Terapkan filter yang diberikan (search, category, create_date) menggunakan scope `filter`
        $contacts = $contacts->filter(request()->only(['query']))->latest();

        // Gunakan paginate() pada builder kueri untuk mengatur jumlah halaman
        $contacts = $contacts->paginate(10)->withQueryString();

        return view('dashboard.contacts.index', [
            'contacts' => $contacts
        ]);
    }

    public function show(Contact $contact)
    {
        return view('dashboard.contacts.show', ['contact' => $contact]);
    }

    public function destroy(Contact $contact)
    {
        try {
            // Hapus entri service dari database
            $contact->delete();

            return redirect()->route('contacts.index')->with('success', 'Email has been deleted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error deleting email: ' . $th->getMessage());

            return redirect()->route('contacts.index')->withErrors([$th->getMessage()]);
        }
    }
}
