<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Option;
use App\Models\Category;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('faqs')
            ->where('type', 'faq')->has('faqs')->get();

        $recentPosts = News::orderBy('created_at', 'desc')->limit(5)->get(); // Ambil 5 postingan terbaru

        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('faqs', [
            'categories' => $categories,
            'recentPosts' => $recentPosts,
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms
        ]);
    }
}
