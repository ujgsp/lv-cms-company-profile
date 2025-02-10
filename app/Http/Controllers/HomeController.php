<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Usps;
use App\Models\Option;
use App\Models\Slider;
use App\Models\Counter;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Category $category = null)
    {
        // return view('home');

        $services = Service::all();

        // Mengambil semua project beserta kategorinya menggunakan eager loading
        $projectsQuery = Project::with(['categories' => function ($query) {
            $query->where('type', 'project');
        }]);

        if ($category) {
            $projectsQuery->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category->id);
            });
        }

        $projects = $projectsQuery->get();

        // Mengambil semua kategori untuk filter
        $project_categories = Category::where('type', 'project')->get();

        $current_category = $category;

        $recentPosts = News::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $usps = Usps::all();

        $sliders = Slider::where('status', 'enable')->get();

        $counters = Counter::all();

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

        // option contact info
        $contactSettings = Option::where('option_name', 'setting_contact_info')->first();
        $opt_contact = json_decode($contactSettings->option_value, true);

        // Ambil data JSON dari database
        $settings = Option::where('option_name', 'setting_homepage')->first();
        $opt_homepage = json_decode($settings->option_value, true);

        // about us
        $aboutUssettings = Option::where('option_name', 'setting_about_us')->first();
        $opt_about_us = json_decode($aboutUssettings->option_value, true);

        $data = [
            'services' => $services,
            'projects' => $projects,
            'project_categories' => $project_categories,
            'current_category' => $current_category,
            'recentPosts' => $recentPosts,
            'usps' => $usps,
            'sliders' => $sliders,
            'counters' => $counters,
            'seo_service' => $opt_seo,
            'site_info' => $opt_site,
            'cms_setting' => $opt_cms,
            'opt_ads' => $opt_ads,
            'opt_contact' => $opt_contact,
            'opt_about_us' => $opt_about_us,
        ];

        // Pilih view berdasarkan pengaturan homepage yang dipilih
        if ($opt_homepage['homepage'] == 'default') {
            return view('home', $data);
        } elseif ($opt_homepage['homepage'] == '02') {
            return view('homepage-02', $data);
        }

        // return view('home', $data);
    }
}
