<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardCacheController;
use App\Models\Page;
use App\Models\Member;
use App\Models\Option;


use App\Models\Counter;
use App\Models\Pricing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardFaqController;
use App\Http\Controllers\DashboardNewsController;
use App\Http\Controllers\DashboardPageController;
use App\Http\Controllers\DashboardUspsController;
use App\Http\Controllers\DashboardMemberController;
use App\Http\Controllers\DashboardSliderController;
use App\Http\Controllers\DashboardCounterController;
use App\Http\Controllers\DashboardPartnerController;
use App\Http\Controllers\DashboardPricingController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\DashboardServiceController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardContactController;
use App\Http\Controllers\DashboardExternalLinkController;
use App\Http\Controllers\DashboardTestimonialController;
use App\Http\Controllers\DashboardNewsCategoryController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\DashboardProjectCategoryController;
use App\Http\Controllers\DashboardQuoteController;
use App\Http\Controllers\DashboardSubscriberController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SubscriberController;
use App\Models\Service;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// -------------------------------------------------------------
// FRONTEND
// -------------------------------------------------------------

// Route::get('/', function () {

//     // $data['services'] = Service::all();
//     return view('home');
// })->middleware('header.data')->name('frontend.index');

// Route::get('/about', function () {
//     return view('about');
// })->middleware('header.data')->name('frontend.about');

Auth::routes([
    'register' => false,
    'verify' => true
]);

Route::get('/view_mail', function(){
    return view('mails.tes');
});


Route::group([
    'prefix' => '/',
    // 'middleware' => [
    //     // 'header.data',
    //     // 'footer.data'
    // ]
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

    Route::get('/about', function () {
        $members = Member::where('status', 'enable')->get();
        $counters = Counter::all();

        $about_us = Option::where('option_name', 'setting_about_us')->first();
        $opt_about_us = json_decode($about_us->option_value);

        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('about', [
            'members' => $members,
            'counters' => $counters,
            'opt_about_us' => $opt_about_us,
            'members' => $members,
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms
        ]);
    })->name('frontend.about');

    // service
    Route::get('/services', [ServiceController::class, 'index'])->name('frontend.services.index');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('frontend.services.detail');

    // project
    Route::get('/projects', [ProjectController::class, 'index'])->name('frontend.projects.index');
    Route::get('/projects/{category:slug}', [ProjectController::class, 'show'])->name('frontend.projects.category');
    Route::get('/project/{project:slug}', [ProjectController::class, 'single'])->name('frontend.projects.single');

    // news
    Route::get('/blogs', [NewsController::class, 'index'])->name('frontend.news.index');
    Route::get('/blogs/{news:slug}', [NewsController::class, 'show'])->name('frontend.news.single');

    // pages
    Route::get('/page/{page:slug}', function (Page $page) {
        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('page', [
            'page' => $page,
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms
        ]);
    })->name('frontend.page');

    // faqs
    Route::get('/faqs', [FaqController::class, 'index'])->name('frontend.faqs.index');

    // contact
    Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('frontend.contact.store');
    Route::get('/test', [ContactController::class, 'test']);

    // Get A Quote
    Route::get('/getQuote', [QuoteController::class, 'index'])->name('frontend.getQuote.index');
    Route::post('/getQuote', [QuoteController::class, 'store'])->name('frontend.getQuote.store');

    // subscribe
    Route::post('/subscriber', [SubscriberController::class, 'store'])->name('frontend.subscriber.store');

    // pricing
    Route::get('/pricing', function () {
        // Data pricing
        // Mengambil semua paket harga dari database
        $pricing = Pricing::with('pricingFeatures')->get();

        // Ambil data SEO dari database
        $seoSettings = Option::where('option_name', 'setting_seo')->first();
        $opt_seo = json_decode($seoSettings->option_value, true);

        // Ambil data Site Info dari database
        $siteSettings = Option::where('option_name', 'setting_site_info')->first();
        $opt_site = json_decode($siteSettings->option_value, true);

        // cms setting
        $cmsSettings = Option::where('option_name', 'setting_section_cms')->first();
        $opt_cms = json_decode($cmsSettings->option_value, true);

        return view('pricing', [
            'pricing' => $pricing,
            'seo_setting' => $opt_seo,
            'site_setting' => $opt_site,
            'cms_setting' => $opt_cms
        ]);
    })->name('frontend.pricing');
});



// -------------------------------------------------------------
// BACKEND
// -------------------------------------------------------------

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['web', 'auth', 'demo']
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // dashboard category
    Route::get('/categories/checkSlug', [DashboardCategoryController::class, 'checkSlug']);
    // Route to fetch updated category options
    Route::get('/categories/options/{type}', [DashboardCategoryController::class, 'getCategoryOptions'])->name('categories.options');
    Route::post('/categories/storeFromAjax', [DashboardCategoryController::class, 'storeFromAjax'])->name('categories.storeFromAjax');
    Route::resource('/categories', DashboardCategoryController::class)->except('show');

    // dashboard services
    Route::get('/services/checkSlug', [DashboardServiceController::class, 'checkSlug']);
    Route::resource('/services', DashboardServiceController::class)->except('show');

    // dashboard project categories
    Route::get('/projectCategories/checkSlug', [DashboardProjectCategoryController::class, 'checkSlug']);
    Route::resource('/projectCategories', DashboardProjectCategoryController::class)->except('show');

    // dashboard projects
    Route::get('/projects/checkSlug', [DashboardProjectController::class, 'checkSlug']);
    Route::resource('/projects', DashboardProjectController::class)->except('show');

    // dashboard news categories
    Route::get('/newsCategories/checkSlug', [DashboardNewsCategoryController::class, 'checkSlug']);
    Route::resource('/newsCategories', DashboardNewsCategoryController::class)->except('show');

    // dashboard news
    Route::get('/news/checkSlug', [DashboardNewsController::class, 'checkSlug']);
    Route::resource('/news', DashboardNewsController::class)->except('show');

    // dashboard pages
    Route::get('/pages/checkSlug', [DashboardPageController::class, 'checkSlug']);
    Route::resource('/pages', DashboardPageController::class)->except('show');

    // dashboard pricing
    Route::post('/pricings/toggleFeatured', [DashboardPricingController::class, 'toggleFeatured'])->name('pricings.toggleFeatured');
    Route::resource('/pricings', DashboardPricingController::class)->except('show');

    // dashboard faqs
    Route::resource('/faqs', DashboardFaqController::class)->except('show');

    // dashboard members
    Route::resource('/members', DashboardMemberController::class);

    // dashboard partners
    Route::resource('/partners', DashboardPartnerController::class)->except('show');

    // dashboard testimonials
    Route::resource('/testimonials', DashboardTestimonialController::class)->except('show');

    // dashboard usps
    Route::resource('/usps', DashboardUspsController::class)->except('show');

    // dashboard sliders
    Route::post('/sliders/toggleFeatured', [DashboardSliderController::class, 'toggleFeatured'])->name('sliders.toggleFeatured');
    Route::resource('/sliders', DashboardSliderController::class)->except('show');

    // dashboard counters
    Route::resource('/counters', DashboardCounterController::class)->except('show');

    // dashboard about
    Route::get('/aboutUs', [DashboardSettingController::class, 'aboutUs'])->name('about.index');
    Route::put('/aboutUs/{option}', [DashboardSettingController::class, 'updateAboutUs'])->name('about.update');

    // dashboard quotes
    Route::resource('/quotes', DashboardQuoteController::class)->except(['edit', 'update', 'create', 'store']);

    // dashboard contact
    Route::get('/contacts', [DashboardContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [DashboardContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [DashboardContactController::class, 'destroy'])->name('contacts.destroy');

    // dashboard subscriber
    Route::get('/subscribers', [DashboardSubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{subscriber}', [DashboardSubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // dashboard header & footer link or external link
    Route::post('/links/toggleStatus', [DashboardExternalLinkController::class, 'toggleStatus'])->name('links.toggleStatus');
    Route::resource('/links', DashboardExternalLinkController::class)->except('show');

    // dashboard profile
    Route::get('/profile/edit', [DashboardProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [DashboardProfileController::class, 'update'])->name('profile.update');


    // clear all cache
    Route::get('/destroy-cache', [DashboardCacheController::class, 'destroy'])->name('cache.destroy');

    // settings
    Route::group([
        'prefix' => 'settings',
    ], function () {
        // General
        Route::get('/', [DashboardSettingController::class, 'index'])->name('settings.index');
        Route::put('/site/{option}', [DashboardSettingController::class, 'updateGeneral'])->name('settings.general.update');

        // SEO settings
        Route::get('/seo', [DashboardSettingController::class, 'seo'])->name('settings.seo');
        Route::put('/seo/{option}', [DashboardSettingController::class, 'updateSeo'])->name('settings.seo.update');

        // Contact
        Route::get('/contact', [DashboardSettingController::class, 'contact'])->name('settings.contact');
        Route::put('/contact/{option}', [DashboardSettingController::class, 'updateContact'])->name('settings.contact.update');

        // About Us
        // Route::get('/about', [DashboardSettingController::class, 'aboutUs'])->name('settings.aboutUs');

        // Ad spots settings
        Route::get('/ads', [DashboardSettingController::class, 'ads'])->name('settings.ads');
        Route::put('/ads/{option}', [DashboardSettingController::class, 'updateAds'])->name('settings.ads.update');

        // tools settings
        Route::get('/tools', [DashboardSettingController::class, 'tools'])->name('settings.tools');
        Route::put('/tools/{option}', [DashboardSettingController::class, 'updateTools'])->name('settings.tools.update');

        // tools API
        Route::get('/api', [DashboardSettingController::class, 'api'])->name('settings.api');
        Route::put('/api/{option}', [DashboardSettingController::class, 'updateApi'])->name('settings.api.update');

        // CMS Section Settings
        Route::get('/cms-section', [DashboardSettingController::class, 'cmsSection'])->name('settings.cms.index');
        Route::put('/cms/{option}', [DashboardSettingController::class, 'updateCms'])->name('settings.cms.update');

        // Navbar Settings
        Route::get('/appearance-navbar', [DashboardSettingController::class, 'appearanceNavbar'])->name('settings.navbar.index');
        Route::put('/appearance-navbar/{option}', [DashboardSettingController::class, 'updateAppearanceNavbar'])->name('settings.navbar.update');

        // Homepage Settings
        Route::get('/appearance-homepage', [DashboardSettingController::class, 'appearanceHomepage'])->name('settings.homepage.index');
        Route::put('/appearance-homepage/{option}', [DashboardSettingController::class, 'updateAppearanceHomepage'])->name('settings.homepage.update');
    });
});

// -------------------------------------------------------------
