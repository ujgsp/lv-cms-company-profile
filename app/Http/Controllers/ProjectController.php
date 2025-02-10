<?php

namespace App\Http\Controllers;

use App\Models\Usps;
use App\Models\Option;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request, Category $category = null)
    {
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

        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        $usps = Usps::all();

        return view('projects', [
            'projects' => $projects,
            'project_categories' => $project_categories,
            'current_category' => $current_category,
            'site_setting' => $opt_site,
            'seo_setting' => $opt_seo,
            'cms_setting' => $opt_cms,
            'usps' => $usps,
        ]);
    }


    public function show(Category $category)
    {
        $projects = $category->projects;

        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('project', [
            'project_categories' => Category::where('type', 'project')->get(),
            'projects' => $projects,
            'current_category' => $category,
            'site_setting' => $opt_site,
            'seo_setting' => $opt_seo,
            'cms_setting' => $opt_cms
        ]);
    }

    public function single(Project $project)
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

        return view('project-single', [
            'project' => $project,
            'site_setting' => $opt_site,
            'seo_setting' => $opt_seo,
            'cms_setting' => $opt_cms,
            'opt_ads' => $opt_ads,
        ]);
    }
}
