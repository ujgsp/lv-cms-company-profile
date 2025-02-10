@extends('layouts.frontend')

@section('title', 'Services - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'Services - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_service['seo_service']['keywords'])
@section('meta_description', $seo_service['seo_service']['description'])
@section('og_image', asset('storage/' . $seo_service['open_graph_image']))

{{-- content here --}}
@section('content')
<div id="banner-area" class="banner-area" style="background-image:url({{ $cms_setting['section_service']['image'] ? asset('storage/' . $cms_setting['section_service']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">Services</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Services</li>
                            </ol>
                        </nav>
                    </div>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Banner text end -->
</div><!-- Banner area end -->

<section id="ts-service-area" class="ts-service-area pb-0">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">{{ $cms_setting['section_service']['text_main'] }}</h2>
                <h3 class="section-sub-title">{{ $cms_setting['section_service']['text_secondary'] }}</h3>
            </div>
        </div>
        <!--/ Title row end -->

        <div class="row">
            <!-- Assuming you want to divide the services into two columns around the image -->
            <div class="col-lg-6">
                @foreach ($services->slice(0, ceil($services->count() / 2)) as $service)
                <div class="ts-service-box d-flex">
                    <div class="ts-service-box-img">
                        <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" />
                    </div>
                    <div class="ts-service-box-info">
                        <h3 class="service-box-title"><a href="{{ route('frontend.services.detail', $service) }}">{{ $service->title }}</a></h3>
                        <p>{{ $service->excerpt }}</p>
                    </div>
                </div><!-- Service item end -->
                @endforeach
            </div><!-- Col end -->

            <div class="col-lg-6">
                @foreach ($services->slice(ceil($services->count() / 2)) as $service)
                <div class="ts-service-box d-flex">
                    <div class="ts-service-box-img">
                        <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" />
                    </div>
                    <div class="ts-service-box-info">
                        <h3 class="service-box-title"><a href="{{ route('frontend.services.detail', $service) }}">{{ $service->title }}</a></h3>
                        <p>{{ $service->excerpt }}</p>
                    </div>
                </div><!-- Service item end -->
                @endforeach
            </div><!-- Col end -->
        </div><!-- Content row end -->

    </div><!-- Container end -->
</section><!-- Service end -->

@include('layouts._frontend._partials.testimonials')
@endsection


