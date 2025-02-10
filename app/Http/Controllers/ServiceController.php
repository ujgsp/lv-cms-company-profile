<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('services', [
            'services' => Service::all(),
            'seo_service' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms
        ]);
    }

    public function show(Service $service)
    {
        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        // ads
        $adSettings = Option::where('option_name', 'setting_ad_spot')->first();
        // Decode JSON menjadi array atau objek
        $opt_ads = json_decode($adSettings->option_value, true);

        return view('service', [
            'service' => $service,
            'services' => Service::all(),
            'seo_service' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms,
            'opt_ads' => $opt_ads,
        ]);
    }
}
