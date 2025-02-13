<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Option;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Category;
use App\Models\ExternalLink;
use App\Models\Testimonial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Menggunakan View::composer untuk berbagi data ke view tertentu
        $file_partials = [
            'layouts._frontend.navbar',
            'layouts._frontend.navbar-02',
            'layouts._frontend.footer',
            'layouts.frontend',
            'layouts._frontend._partials.testimonials',
            'layouts._frontend.auth'
        ];

        View::composer($file_partials, function ($view) {
            $navigation = Cache::remember('navigation_data', now()->addHours(6), function () {
                $option = Option::where('option_name', 'setting_tools')->first();
                return $option ? json_decode($option->option_value, true) : [];
            });

            $partners = Cache::remember('partners_data', now()->addHours(6), function () {
                return Partner::where('status', 'publish')->get();
            });

            $services = Cache::remember('services_data', now()->addHours(6), function () {
                return Service::all();
            });

            $project_categories = Cache::remember('project_categories_data', now()->addHours(6), function () {
                return Category::where('type', 'project')->get();
            });

            $pages = Cache::remember('header_pages_data', now()->addHours(6), function () {
                return Page::where('status', 'publish')
                    ->where('location', 'header')
                    ->orWhere('location', 'both')
                    ->get();
            });

            $pages_footer = Cache::remember('footer_pages_data', now()->addHours(6), function () {
                return Page::where('status', 'publish')
                    ->where('location', 'footer')
                    ->orWhere('location', 'both')
                    ->get();
            });

            $opt_site = Cache::remember('site_info_data', now()->addHours(6), function () {
                $site_info = Option::where('option_name', 'setting_site_info')->first();
                return json_decode($site_info->option_value);
            });

            $opt_contact = Cache::remember('contact_info_data', now()->addHours(6), function () {
                $contact_info = Option::where('option_name', 'setting_contact_info')->first();
                return json_decode($contact_info->option_value);
            });

            $opt_ads = Cache::remember('ad_settings_data', now()->addHours(6), function () {
                $adSettings = Option::where('option_name', 'setting_ad_spot')->first();
                return json_decode($adSettings->option_value, true);
            });

            $testimonials = Cache::remember('testimonials_data', now()->addHours(6), function () {
                return Testimonial::where('status', 'enable')->get();
            });

            $externalLinkHeaders = Cache::remember('external_links_header_data', now()->addHours(6), function () {
                return ExternalLink::where('status', 'enable')
                    ->where('placement', 'header')
                    ->orWhere('placement', 'both')
                    ->get();
            });

            // $externalLinkHeaders = ExternalLink::where('status', 'enable')
            //         ->where('placement', 'header')
            //         ->orWhere('placement', 'both')
            //         ->get();

            $externalLinkFooters = Cache::remember('external_links_footer_data', now()->addHours(6), function () {
                return ExternalLink::where('status', 'enable')
                    ->where('placement', 'footer')
                    ->orWhere('placement', 'both')
                    ->get();
            });

            $opt_about_us = Cache::remember('about_us_data', now()->addHours(6), function () {
                $about_us = Option::where('option_name', 'setting_about_us')->first();
                return json_decode($about_us->option_value, true);
            });

            $opt_appearance_navbar = Cache::remember('appearance_navbar_data', now()->addHours(6), function () {
                $appearance_navbar_data = Option::where('option_name', 'setting_navbar')->first();
                return json_decode($appearance_navbar_data->option_value, true);
            });

            // Mengirimkan data ke view
            $view->with('navigation', $navigation);
            $view->with('services', $services);
            $view->with('project_categories', $project_categories);
            $view->with('pages', $pages);
            $view->with('pages_footer', $pages_footer);
            $view->with('opt_site', $opt_site);
            $view->with('opt_contact', $opt_contact);
            $view->with('opt_ads', $opt_ads);
            $view->with('testimonials', $testimonials);
            $view->with('partners', $partners);
            $view->with('external_link_headers', $externalLinkHeaders);
            $view->with('external_link_footers', $externalLinkFooters);
            $view->with('opt_about_us', $opt_about_us);
            $view->with('navbarConfig', $opt_appearance_navbar);
        });
    }
}
