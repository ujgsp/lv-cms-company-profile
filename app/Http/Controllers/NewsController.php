<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Option;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = request('category');

        // Mengambil berita dengan kategori yang sesuai jika ada filter kategori
        $newsQuery = News::with('category')->where('status', 'publish');

        if ($category) {
            $newsQuery->whereHas('category', function ($query) use ($category) {
                $query->where('title', $category);
            });
        }

        $news = $newsQuery->paginate(10);
        $categories = Category::where('type', 'news')->get();

        // Mengambil berita terbaru
        $recentPosts = News::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Mengambil data arsip
        $archives = News::where('status', 'publish')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // seo setting
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // site info
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        // ads
        $adSettings = Option::where('option_name', 'setting_ad_spot')->first();
        // Decode JSON menjadi array atau objek
        $opt_ads = json_decode($adSettings->option_value, true);

        return view('news', [
            'news' => $news,
            'categories' => $categories,
            'archives' => $archives,
            'recentPosts' => $recentPosts,
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms,
            'opt_ads' => $opt_ads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(News $news)
    {
        $recentPosts = News::where('status', 'publish')
            ->latest()
            ->take(5)
            ->get();
        $categories = Category::where('type', 'news')->get();
        $archives = News::where('status', 'publish')
            ->selectRaw('year(created_at) year, month(created_at) month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

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

        return view('news-single', [
            'news' => $news,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'archives' => $archives,
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms,
            'opt_ads' => $opt_ads,
        ]);
    }
}
