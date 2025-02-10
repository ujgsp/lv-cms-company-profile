<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Page;
use App\Models\Option;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FooterDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $pages = Page::where('status', 'publish')
        // ->where('location', 'footer')
        // ->orWhere('location', 'both')
        // ->get();

        $site_info = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($site_info->option_value);

        $contact_info = Option::where('option_name', 'setting_contact_info')->first();
        $opt_contact = json_decode($contact_info->option_value);

        // ad spot footer
        // Ambil data JSON dari database
        $adSettings = Option::where('option_name', 'setting_ad_spot')->first();
        // Decode JSON menjadi array atau objek
        $opt_ads = json_decode($adSettings->option_value, true);

        // view()->share('footer_opt_ads', $opt_ads);
        // view()->share('footer_opt_contact', $opt_contact);
        // view()->share('footer_opt_site', $opt_site);
        // view()->share('footer_pages', $pages);

        return $next($request);
    }
}
