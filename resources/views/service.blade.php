@extends('layouts.frontend')

@section('title', $service->title . ' - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', $service->title . ' - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_service['seo_service']['keywords'])
@section('meta_description', $service->excerpt)
@section('og_image', asset('storage/' . $seo_service['open_graph_image']))

@section('content')
<div id="banner-area" class="banner-area" style="background-image:url({{ $cms_setting['section_service']['image'] ? asset('storage/' . $cms_setting['section_service']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">{{ $service->title }}</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active"
                                        aria-current="page">Services</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container"
             class="main-container">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-4">
                    <div class="sidebar sidebar-left">
                        <div class="widget">
                            <h3 class="widget-title">Solutions</h3>
                            <ul class="nav service-menu">
                                @foreach ($services as $s)
                                    <li class="@if ($s->id == $service->id) active @endif"><a
                                           href="{{ route('frontend.services.detail', $s) }}">{{ $s->title }}</a></li>
                                @endforeach
                            </ul>

                            @if (isset($opt_ads['ad_middle']) && $opt_ads['ad_middle']['ad_status'] == 'enable')
                                {{-- Iklan di tengah halaman --}}
                                <div class="middle-ad mt-3">
                                    {{-- Menambahkan kelas img-fluid pada elemen <img> --}}
                                    {!! str_replace('<img', '<img class="img-fluid"', $opt_ads['ad_middle']['ad_code']) !!}
                                </div>
                            @endif

                        </div><!-- Widget end -->
                    </div><!-- Sidebar end -->
                </div><!-- Sidebar Col end -->

                <div class="col-xl-8 col-lg-8">
                    <div class="content-inner-page">
                        <h2 class="column-title mrt-0">{{ $service->title }}</h2>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($service->body)
                                <p>{!! $service->body !!}</p>
                                @else
                                <p>No description</p>
                                @endif

                            </div>
                        </div>

                        <div class="gap-40"></div>
                        <div class="call-to-action classic">
                            <div class="row align-items-center">
                                <div class="col-md-8 text-center text-md-left">
                                    <div class="call-to-action-text">
                                        <h3 class="action-title">Interested with this service.</h3>
                                    </div>
                                </div><!-- Col end -->
                                <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                                    <div class="call-to-action-btn">
                                        <a class="btn btn-primary"
                                           href="{{ route('frontend.getQuote.index', ['order' => $service->id]) }}">Get a
                                            Quote</a>
                                    </div>
                                </div><!-- col end -->
                            </div><!-- row end -->
                        </div>

                        <!-- You can continue to display other information dynamically -->

                    </div><!-- Content inner end -->
                </div><!-- Content Col end -->

            </div><!-- Main row end -->
        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
