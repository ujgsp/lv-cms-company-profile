<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DashboardSettingController extends Controller
{
    /**
     * General info
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $site_info = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($site_info->option_value);

        return view('dashboard.settings.general', compact('opt_site'));
    }

    public function updateGeneral(Request $request, Option $option)
    {

        // Validasi input
        $validatedData = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'website' => 'required|string',
            'footer' => 'required|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
        ], [
            'website.required' => 'The website name field is required.',
            'footer.required' => 'The footer attribution  field is required.',
        ]);

        try {

            $oldImageLogo = $request->oldImageLogo;
            if ($request->hasFile('logo')) {
                // Hapus gambar lama dari penyimpanan
                if ($oldImageLogo) {
                    Storage::delete('public/' . $oldImageLogo);
                }
                // Simpan gambar baru ke penyimpanan
                $imagePath = $request->file('logo')->store('setting-images', 'public');
                $validatedData['logo'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['logo'] = $oldImageLogo;
            }

            $oldImageFavicon = $request->oldImageFavicon;
            if ($request->hasFile('favicon')) {
                // Hapus gambar lama dari penyimpanan
                if ($oldImageFavicon) {
                    Storage::delete('public/' . $oldImageFavicon);
                }
                // Simpan gambar baru ke penyimpanan
                $imagePath = $request->file('favicon')->store('setting-images', 'public');
                $validatedData['favicon'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['favicon'] = $oldImageFavicon;
            }

            $oldImageLogoFooter = $request->oldImageLogoFooter;
            if ($request->hasFile('logo_footer')) {
                // Hapus gambar lama dari penyimpanan
                if ($oldImageLogoFooter) {
                    Storage::delete('public/' . $oldImageLogoFooter);
                }
                // Simpan gambar baru ke penyimpanan
                $imagePath = $request->file('logo_footer')->store('setting-images', 'public');
                $validatedData['logo_footer'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['logo_footer'] = $oldImageLogoFooter;
            }

            // Update option values
            $optionValue = [
                'logo' => $validatedData['logo'],
                'favicon' => $validatedData['favicon'],
                'logo_footer' => $validatedData['logo_footer'],
                'website_name' => $validatedData['website'],
                'footer' => $validatedData['footer'],
                'facebook' => $validatedData['facebook'],
                'instagram' => $validatedData['instagram'],
                'twitter' => $validatedData['twitter'],
                'linkedin' => $validatedData['linkedin'],
            ];

            $option->update([
                'option_value' => json_encode($optionValue),
            ]);

            return redirect()->route('settings.index')->with('success', 'General setting has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating general setting: ' . $th->getMessage());

            return redirect()->route('settings.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    public function updateContact(Request $request, Option $option)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'maps' => 'nullable|string',
            'office_hours' => 'required|string',
            'enable_office_hours' => 'nullable|string',
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|string',
            'smtp_username' => 'required|string',
            'smtp_password' => 'required|string',
            'smtp_encryption' => 'required|string',
            'email_from_name' => 'required|string',
            'smtp_status' => 'nullable|string',
        ]);


        try {
            // Update option values
            $optionValue = [
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'maps' => $validatedData['maps'],
                'office_hours' => $validatedData['office_hours'],
                'enable_office_hours' => $request->has('enable_office_hours') ? 'enable' : 'disable',
                'smtp_host' => $validatedData['smtp_host'],
                'smtp_port' => $validatedData['smtp_port'],
                'smtp_user' => $validatedData['smtp_username'],
                'smtp_pass' => $validatedData['smtp_password'],
                'smtp_encryption' => $validatedData['smtp_encryption'],
                'email_from_name' => $validatedData['email_from_name'],
                'smtp_status' => $request->has('smtp_status') ? 'enable' : 'disable',
            ];

            $option->update([
                'option_value' => json_encode($optionValue),
            ]);

            return redirect()->route('settings.contact')->with('success', 'Contact information has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating contact information: ' . $th->getMessage());

            return redirect()->route('settings.contact')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }


    public function seo()
    {
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);
        return view('dashboard.settings.seo', [
            'opt_seo' => $opt_seo
        ]);
    }

    public function updateSeo(Request $request, Option $option)
    {
        // Validasi input
        $validatedData = $request->validate([
            'seo_service_keywords' => 'nullable|string|max:255',
            'seo_service_description' => 'nullable|string|max:1000',
            'seo_projects_keywords' => 'nullable|string|max:255',
            'seo_projects_description' => 'nullable|string|max:1000',
            'seo_news_keywords' => 'nullable|string|max:255',
            'seo_news_description' => 'nullable|string|max:1000',
            'seo_homepage_keywords' => 'nullable|string|max:255',
            'seo_homepage_description' => 'nullable|string|max:1000',
            'open_graph_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Update pengaturan SEO dengan data baru
            $currentOptionValue['seo_service']['keywords'] = $validatedData['seo_service_keywords'];
            $currentOptionValue['seo_service']['description'] = $validatedData['seo_service_description'];
            $currentOptionValue['seo_project']['keywords'] = $validatedData['seo_projects_keywords'];
            $currentOptionValue['seo_project']['description'] = $validatedData['seo_projects_description'];
            $currentOptionValue['seo_news']['keywords'] = $validatedData['seo_news_keywords'];
            $currentOptionValue['seo_news']['description'] = $validatedData['seo_news_description'];
            $currentOptionValue['seo_homepage']['keywords'] = $validatedData['seo_homepage_keywords'];
            $currentOptionValue['seo_homepage']['description'] = $validatedData['seo_homepage_description'];

            // Upload gambar jika ada file yang diupload
            $oldImage = $request->oldImage;
            if ($request->hasFile('open_graph_image')) {
                // Hapus gambar lama dari penyimpanan
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
                // Simpan gambar baru ke penyimpanan
                $imagePath = $request->file('open_graph_image')->store('option-images', 'public');
                $currentOptionValue['open_graph_image'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $currentOptionValue['open_graph_image'] = $oldImage;
            }

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return redirect()->route('settings.seo')->with('success', 'SEO settings updated successfully.');
        } catch (\Exception $e) {
            // Tangkap kesalahan dan catat
            \Illuminate\Support\Facades\Log::error('Error updating SEO settings: ' . $e->getMessage());

            // Kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return back()->withInput()->withErrors(['message' => 'There was an error updating the SEO settings. Please try again later.']);
        }
    }


    public function contact()
    {
        $contact_info = Option::where('option_name', 'setting_contact_info')->first();
        $opt_contact = json_decode($contact_info->option_value);
        return view('dashboard.settings.contact', compact('opt_contact'));
    }

    public function aboutUs()
    {
        $about_us = Option::where('option_name', 'setting_about_us')->first();
        $opt_about_us = json_decode($about_us->option_value);
        return view('dashboard.settings.about-us', compact('opt_about_us'));
    }

    public function updateAboutUs(Request $request, Option $option)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required',
            'short_description' => 'required|string|max:255',
        ]);


        try {
            $oldImage = $request->oldImage;
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama dari penyimpanan
                if ($oldImage) {
                    Storage::delete('public/' . $oldImage);
                }
                // Simpan gambar baru ke penyimpanan
                $imagePath = $request->file('thumbnail')->store('option-images', 'public');
                $validatedData['thumbnail'] = $imagePath;
            } else {
                // Jika tidak ada file baru, gunakan image yang lama
                $validatedData['thumbnail'] = $oldImage;
            }

            // Update option values
            $optionValue = [
                'title' => $validatedData['title'],
                'thumbnail' => $validatedData['thumbnail'],
                'description' => $validatedData['description'],
                'short_description' => $validatedData['short_description'],
            ];

            $option->update([
                'option_value' => json_encode($optionValue),
            ]);

            return redirect()->route('about.index')->with('success', 'About us has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating about us: ' . $th->getMessage());

            return redirect()->route('about.index')->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    public function ads()
    {
        // Ambil data JSON dari database
        $adSettings = Option::where('option_name', 'setting_ad_spot')->first();
        // Decode JSON menjadi array atau objek
        $opt_ads = json_decode($adSettings->option_value, true);
        return view('dashboard.settings.ads', compact('opt_ads'));
    }

    public function updateAds(Request $request, Option $option)
    {
        $validatedData = $request->validate([
            'ad_middle_status' => 'nullable',
            'ad_middle_code' => 'nullable|string',
            'ad_footer_status' => 'nullable',
            'ad_footer_code' => 'nullable|string',
            'ad_pop_status' => 'nullable',
            'ad_pop_code' => 'nullable|string',
        ]);

        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Perbarui nilai berdasarkan input dari form
            $currentOptionValue['ad_middle'] = [
                'ad_status' => $request->has('ad_middle_status') ? 'enable' : 'disable',
                'ad_code' => $validatedData['ad_middle_code']
            ];

            $currentOptionValue['ad_footer'] = [
                'ad_status' => $request->has('ad_footer_status') ? 'enable' : 'disable',
                'ad_code' => $validatedData['ad_footer_code']
            ];

            $currentOptionValue['ad_pop'] = [
                'ad_status' => $request->has('ad_pop_status') ? 'enable' : 'disable',
                'ad_code' => $validatedData['ad_pop_code']
            ];

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return back()->with('success', 'Ad spot has been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating ad spot: ' . $th->getMessage());

            return back()->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    public function tools()
    {
        // Ambil data JSON dari database
        $toolsSettings = Option::where('option_name', 'setting_tools')->first();
        // Decode JSON menjadi array atau objek
        $opt_tools = json_decode($toolsSettings->option_value, true);
        return view('dashboard.settings.tools', compact('opt_tools'));
    }

    public function updateTools(Request $request, Option $option)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'navig_home' => 'nullable',
            'navig_about' => 'nullable',
            'navig_service' => 'nullable',
            'navig_project' => 'nullable',
            'navig_pricing' => 'nullable',
            'navig_news' => 'nullable',
            'navig_faq' => 'nullable',
            'navig_contact' => 'nullable',
        ]);

        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Array keys yang ingin kita update
            $keys = [
                'navig_home',
                'navig_about',
                'navig_service',
                'navig_project',
                'navig_pricing',
                'navig_news',
                'navig_faq',
                'navig_contact'
            ];

            // Loop melalui setiap key dan perbarui nilai-nilai navigasi
            foreach ($keys as $key) {
                $currentOptionValue[$key]['navig_status'] = $request->has($key) ? 'enable' : 'disable';
            }

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return back()->with('success', 'Navigation settings have been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating navigation settings: ' . $th->getMessage());

            return back()->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    public function api()
    {
        // Ambil data JSON dari database
        $toolsSettings = Option::where('option_name', 'setting_captcha')->first();
        // Decode JSON menjadi array atau objek
        $opt_api = json_decode($toolsSettings->option_value, true);
        return view('dashboard.settings.api', compact('opt_api'));
    }

    public function updateApi(Request $request, Option $option)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'opt_captcha_status' => 'nullable',
            'opt_captcha_site_key' => 'nullable',
            'opt_captcha_secret_key' => 'nullable',
        ]);

        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Perbarui nilai berdasarkan input dari form
            $currentOptionValue['recaptcha_keys'] = [
                'site_key' => $validatedData['opt_captcha_site_key'],
                'secret_key' => $validatedData['opt_captcha_secret_key'],
                'status' => $request->has('opt_captcha_status') ? 'enable' : 'disable',
            ];

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return back()->with('success', 'API settings have been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating API settings: ' . $th->getMessage());

            return back()->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    public function cmsSection()
    {
        // Ambil data JSON dari database
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        // Decode JSON menjadi array atau objek
        $opt_cms = json_decode($cmsSettings->option_value, true);
        return view('dashboard.settings.cms-section', compact('opt_cms'));
    }

    public function updateCms(Request $request, Option $option)
    {
        // Validasi input
        $validatedData = $request->validate([
            'default_banner' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_image_about_us' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_image_service' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_service' => 'required|string|max:255',
            'section_text_secondary_service' => 'required|string|max:255',
            'section_image_project' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_project' => 'required|string|max:255',
            'section_text_secondary_project' => 'required|string|max:255',
            'section_image_pricing' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_pricing' => 'required|string|max:255',
            'section_text_secondary_pricing' => 'required|string|max:255',
            'section_image_news' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_news' => 'required|string|max:255',
            'section_text_secondary_news' => 'required|string|max:255',
            'section_image_faq' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_image_contact' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_contact' => 'required|string|max:255',
            'section_text_secondary_contact' => 'required|string|max:255',
            'section_text_main_get_in_touch' => 'required|string|max:255',
            'section_text_secondary_get_in_touch' => 'required|string|max:255',
            'section_image_quote' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_quote' => 'required|string|max:255',
            'section_text_secondary_quote' => 'required|string|max:255',
            'section_text_main_why_choose_us' => 'required|string|max:255',
            'section_text_secondary_why_choose_us' => 'required|string|max:255',
            'section_text_main_member' => 'required|string|max:255',
            'section_text_secondary_member' => 'required|string|max:255',
            'section_image_statistic' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'section_text_main_statistic' => 'required|string|max:255',
            'section_text_secondary_statistic' => 'required|string|max:255',
            'section_text_description_statistic' => 'required|string|max:255',
        ]);

        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Update data dengan data baru
            $currentOptionValue['section_service']['text_main'] = $validatedData['section_text_main_service'];
            $currentOptionValue['section_service']['text_secondary'] = $validatedData['section_text_secondary_service'];

            $currentOptionValue['section_project']['text_main'] = $validatedData['section_text_main_project'];
            $currentOptionValue['section_project']['text_secondary'] = $validatedData['section_text_secondary_project'];

            $currentOptionValue['section_pricing']['text_main'] = $validatedData['section_text_main_pricing'];
            $currentOptionValue['section_pricing']['text_secondary'] = $validatedData['section_text_secondary_pricing'];

            $currentOptionValue['section_contact']['text_main'] = $validatedData['section_text_main_contact'];
            $currentOptionValue['section_contact']['text_secondary'] = $validatedData['section_text_secondary_contact'];

            $currentOptionValue['section_get_in_touch']['text_main'] = $validatedData['section_text_main_get_in_touch'];
            $currentOptionValue['section_get_in_touch']['text_secondary'] = $validatedData['section_text_secondary_get_in_touch'];

            $currentOptionValue['section_quote']['text_main'] = $validatedData['section_text_main_quote'];
            $currentOptionValue['section_quote']['text_secondary'] = $validatedData['section_text_secondary_quote'];

            $currentOptionValue['section_why_choose_us']['text_main'] = $validatedData['section_text_main_why_choose_us'];
            $currentOptionValue['section_why_choose_us']['text_secondary'] = $validatedData['section_text_secondary_why_choose_us'];

            $currentOptionValue['section_member']['text_main'] = $validatedData['section_text_main_member'];
            $currentOptionValue['section_member']['text_secondary'] = $validatedData['section_text_secondary_member'];

            $currentOptionValue['section_news']['text_main'] = $validatedData['section_text_main_news'];
            $currentOptionValue['section_news']['text_secondary'] = $validatedData['section_text_secondary_news'];

            $currentOptionValue['section_statistic']['text_main'] = $validatedData['section_text_main_statistic'];
            $currentOptionValue['section_statistic']['text_secondary'] = $validatedData['section_text_secondary_statistic'];
            $currentOptionValue['section_statistic']['text_description'] = $validatedData['section_text_description_statistic'];

            // Proses upload gambar menggunakan fungsi
            $currentOptionValue['default_banner']['image'] = $this->uploadAndDeleteOldImage($request->file('default_banner'), $request->imageDefaultBannerOld ?? null, 'cms-option-images');
            $currentOptionValue['section_about_us']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_about_us'), $request->imageSectionAboutUsOld ?? null, 'cms-option-images');
            $currentOptionValue['section_service']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_service'), $request->imageSectionServiceOld ?? null, 'cms-option-images');
            $currentOptionValue['section_project']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_project'), $request->imageSectionProjectOld ?? null, 'cms-option-images');
            $currentOptionValue['section_pricing']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_pricing'), $request->imageSectionPricingOld ?? null, 'cms-option-images');
            $currentOptionValue['section_news']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_news'), $request->imageSectionPricingOld ?? null, 'cms-option-images');
            $currentOptionValue['section_faq']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_faq'), $request->imageSectionFaqOld ?? null, 'cms-option-images');
            $currentOptionValue['section_contact']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_contact'), $request->imageSectionContactOld ?? null, 'cms-option-images');
            $currentOptionValue['section_quote']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_quote'), $request->imageSectionQuoteOld ?? null, 'cms-option-images');
            $currentOptionValue['section_statistic']['image'] = $this->uploadAndDeleteOldImage($request->file('section_image_statistic'), $request->imageSectionStatisticOld ?? null, 'cms-option-images');

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return back()->with('success', 'CMS Section settings updated successfully.');
        } catch (\Exception $e) {
            // Tangkap kesalahan dan catat
            \Illuminate\Support\Facades\Log::error('Error updating CMS Section settings: ' . $e->getMessage());

            // Kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return back()->withInput()->withErrors(['message' => 'There was an error updating the CMS Section settings. Please try again later.']);
        }
    }

    /**
     * Fungsi untuk meng-upload dan menghapus gambar lama.
     *
     * @param \Illuminate\Http\UploadedFile|null $file
     * @param string|null $oldImage
     * @param string $directory
     * @return string|null
     */
    function uploadAndDeleteOldImage($file, $oldImage, $directory)
    {
        // Simpan gambar baru ke penyimpanan
        if ($file) {
            // Hapus gambar lama dari penyimpanan jika ada
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            return $file->store($directory, 'public');
        } else {
            return $oldImage;
        }
    }

    /* Appearance Navbar */
    public function appearanceNavbar()
    {
        // Ambil data JSON dari database
        $settings = Option::where('option_name', 'setting_navbar')->first();
        // Decode JSON menjadi array atau objek
        $opt_appearance_navbar = json_decode($settings->option_value, true);
        return view('dashboard.settings.appearance-navbar', ['opt_appearance_navbar' => $opt_appearance_navbar]);
    }

    public function updateAppearanceNavbar(Request $request, Option $option)
    {
        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Ambil nilai dari input 'navbar'
            $currentOptionValue['navbar'] = $request->input('navbar');

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return back()->with('success', 'Navbar settings have been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating navbar settings: ' . $th->getMessage());

            return back()->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }

    /* Appearance Homepage */
    public function appearanceHomepage()
    {
        // Ambil data JSON dari database
        $settings = Option::where('option_name', 'setting_homepage')->first();
        // Decode JSON menjadi array atau objek
        $opt_appearance_homepage = json_decode($settings->option_value, true);
        return view('dashboard.settings.appearance-homepage', ['opt_appearance_homepage' => $opt_appearance_homepage]);
    }

    public function updateAppearanceHomepage(Request $request, Option $option)
    {
        try {
            // Ambil nilai yang ada dari option_value dan decode JSON-nya
            $currentOptionValue = json_decode($option->option_value, true);

            // Ambil nilai dari input 'navbar'
            $currentOptionValue['homepage'] = $request->input('homepage');

            // Encode kembali ke JSON dan simpan ke database
            $option->update([
                'option_value' => json_encode($currentOptionValue),
            ]);

            return back()->with('success', 'Homepage settings have been updated successfully.');
        } catch (\Throwable $th) {
            // Tangkap dan catat pesan kesalahan
            Log::error('Error updating homepage settings: ' . $th->getMessage());

            return back()->withInput($request->all())->withErrors([$th->getMessage()]);
        }
    }
}
