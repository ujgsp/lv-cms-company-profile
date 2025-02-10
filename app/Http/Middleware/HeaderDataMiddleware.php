<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Page;
use App\Models\Service;
use App\Models\Category;
use App\Models\Option;
use App\Models\Partner;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeaderDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $services = Service::all();

        $project_categories = Category::where('type', 'project')->get();

        $pages = Page::where('status', 'publish')
        ->where('location', 'header')
        ->orWhere('location', 'both')
        ->get();

        $partners = Partner::where('status', 'publish')->get();

        $testimonials = Testimonial::where('status', 'enable')->get();

        $site_info = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($site_info->option_value);

        // ad spot header
        // Ambil data JSON dari database
        $adSettings = Option::where('option_name', 'setting_ad_spot')->first();
        // Decode JSON menjadi array atau objek
        $opt_ads = json_decode($adSettings->option_value, true);

        $option = Option::where('option_name', 'setting_tools')->first();
        $navigation = json_decode($option->option_value, true);

        // view()->share('header_navigation', $navigation);
        view()->share('header_opt_ads', $opt_ads);
        // view()->share('header_opt_site', $opt_site);
        view()->share('header_testimonials', $testimonials);
        view()->share('header_partners', $partners);
        // view()->share('header_pages', $pages);
        // view()->share('header_services', $services);
        // view()->share('header_project_categories', $project_categories);

        return $next($request);
    }
}
