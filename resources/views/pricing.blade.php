@extends('layouts.frontend')

@section('title', 'Pricing - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'Pricing - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_homepage']['keywords'])
@section('meta_description', $seo_setting['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
    <div id="banner-area" class="banner-area"
        style="background-image:url({{ $cms_setting['section_pricing']['image'] ? asset('storage/' . $cms_setting['section_pricing']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">

        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">Pricing</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div>

    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">{{ $cms_setting['section_pricing']['text_main'] }}</h2>
                    <h3 class="section-sub-title">{{ $cms_setting['section_pricing']['text_secondary'] }}</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                @foreach ($pricing as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="ts-pricing-box {{ $package->featured ? 'ts-pricing-featured' : '' }}">
                            <div class="ts-pricing-header">
                                <h2 class="ts-pricing-name">{{ $package->name }}</h2>
                                <h2 class="ts-pricing-price">
                                    <span
                                        class="currency">{{ $package->currency }}</span><strong>{{ $package->price }}</strong><small>{{ $package->duration }}</small>
                                </h2>
                            </div><!-- Pricing header -->
                            <div class="ts-pricing-features">
                                <ul class="list-unstyled">
                                    @foreach ($package->pricingFeatures as $feature)
                                        <li>{{ $feature->feature }}</li>
                                    @endforeach
                                </ul>
                            </div><!-- Features end -->
                            <div class="plan-action">
                                <a href="{{ route('frontend.contact.index') }}"
                                    class="btn btn-{{ $package->featured ? 'primary' : 'dark' }}">Order Now</a>
                            </div>
                        </div><!-- Plan end -->
                    </div><!-- Col end -->
                @endforeach
            </div>
            <!--/ Content row end -->
        </div><!-- Container end -->
    </section><!-- Pricing section end -->
@endsection
