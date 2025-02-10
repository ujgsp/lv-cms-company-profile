<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contact_info = Option::where('option_name', 'setting_contact_info')->first();
        $opt_contact = json_decode($contact_info->option_value);

        // Ambil data JSON dari database
        $toolsSettings = Option::where('option_name', 'setting_captcha')->first();
        // Decode JSON menjadi array atau objek
        $opt_api = json_decode($toolsSettings->option_value, true);

        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('contact', [
            'opt_contact' => $opt_contact,
            'opt_api' => $opt_api['recaptcha_keys'],
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms
        ]);
    }

    // store with send email if status smtp enable
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Ambil secret key dari database
        $toolsSettings = Option::where('option_name', 'setting_captcha')->first();
        $opt_api = json_decode($toolsSettings->option_value, true);
        $secretKey = $opt_api['recaptcha_keys']['secret_key'];

        if ($opt_api['recaptcha_keys']['status'] == 'enable') {
            // Validasi reCAPTCHA jika diaktifkan
            $request->validate([
                'g-recaptcha-response' => 'required',
            ], [
                'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.',
            ]);

            // Validate the reCAPTCHA response
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $responseData = $response->json();

            if (!$responseData['success']) {
                return back()->withInput()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.']);
            }
        }

        try {

            // ambil nama aplikasi untuk keperluan subject email
            $opt_site = Option::where('option_name', 'setting_site_info')->first();
            $data = json_decode($opt_site->option_value, true);
            $website_name = $data['website_name'];


            // sending email
            // Ambil pengaturan SMTP dari database
            $opt_email = Option::where('option_name', 'setting_contact_info')->first();
            $setting_email = json_decode($opt_email->option_value, true);

            // cek status settingan smtp apakah status smtp enable
            if ($setting_email['smtp_status'] == 'enable') {
                // Konfigurasi mailer
                config([
                    'mail.mailers.smtp.host' => $setting_email['smtp_host'],
                    'mail.mailers.smtp.port' => $setting_email['smtp_port'],
                    'mail.mailers.smtp.username' => $setting_email['smtp_user'],
                    'mail.mailers.smtp.password' => $setting_email['smtp_pass'],
                    'mail.mailers.smtp.encryption' => $setting_email['smtp_encryption'],
                    'mail.from.address' => $setting_email['email'],
                    'mail.from.name' => $setting_email['email_from_name'],
                ]);

                Mail::to($setting_email['email'])
                    ->send(new ContactMail($validatedData, $website_name));
            }


            // Simpan data
            Contact::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
            ]);

            return back()->with('success', 'Contact request submitted successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            \Illuminate\Support\Facades\Log::error('Error creating frontend contact: ' . $th->getMessage());

            return back()->withInput()->withErrors(['message' => 'There was an error submitting your contact request. Please try again later.']);
        }
    }

    public function test()
    {
        $service_title = \App\Models\Service::where('id', 2)->value('title');
        echo $service_title;
    }
}
