@extends('layouts.frontend')

@section('title', 'Homepage - ' . $site_info['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'Homepage - ' . $site_info['website_name'])
@section('meta_keywords', $seo_service['seo_homepage']['keywords'])
@section('meta_description', $seo_service['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_service['open_graph_image']))

@section('content')
    <div class="banner-carousel banner-carousel-1 mb-0">
        @foreach ($sliders as $slider)
            <div class="banner-carousel-item"
                style="background-image:url({{ $slider->thumbnail ? asset('storage/' . $slider->thumbnail) : asset('static/images/slider-main/bg2.jpg') }})">
                <div class="slider-content">
                    <div class="container h-100">
                        <div class="row align-items-center h-100">
                            <div class="col-md-12 text-center">
                                <h2 class="slide-title" data-animation-in="slideInLeft">{{ $slider->text_primary }}</h2>
                                <h3 class="slide-sub-title" data-animation-in="slideInRight">{{ $slider->text_secondary }}
                                </h3>
                                <p data-animation-in="slideInLeft" data-duration-in="1.2">
                                    <a href="{{ $slider->btn_link }}"
                                        class="slider btn btn-primary">{{ $slider->btn_title }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <section class="call-to-action-box no-padding">
        <div class="container">
            <div class="action-style-box">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-left">
                        <div class="call-to-action-text">
                            <h3 class="action-title">We understand your needs on construction</h3>
                        </div>
                    </div><!-- Col end -->
                    <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                        <div class="call-to-action-btn">
                            <a class="btn btn-dark" href="{{ route('frontend.getQuote.index') }}">Request Quote</a>
                        </div>
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- Action style box -->
        </div><!-- Container end -->
    </section><!-- Action end -->

    <section id="ts-features" class="ts-features pb-2">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">{{ $cms_setting['section_why_choose_us']['text_main'] }}</h2>
                    <h3 class="section-sub-title">{{ $cms_setting['section_why_choose_us']['text_secondary'] }}</h3>
                </div>
            </div>

            <div class="row">
                @foreach ($usps as $usp)
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-5">
                        <div class="ts-service-box">

                            <div class="d-flex">
                                <div class="ts-service-box-img">
                                    @if ($usp->image)
                                        <img loading="lazy" src="{{ asset('storage/' . $usp->image) }}"
                                            alt="service-icon" />
                                    @else
                                        <img loading="lazy"
                                            src="{{ asset('static/images/icon-image/placeholder_icon.png') }}"
                                            alt="service-icon" />
                                    @endif
                                </div>
                                <div class="ts-service-info">
                                    <h3 class="service-box-title">{{ $usp->title }}</h3>
                                    <p>{{ $usp->description }}</p>
                                </div>
                            </div>
                        </div><!-- Service1 end -->
                    </div>
                @endforeach
            </div><!-- Content row end -->
        </div><!-- Container end -->
    </section><!-- Feature are end -->

    <section id="facts" class="facts-area dark-bg">
        <div class="container">
            <div class="facts-wrapper">
                <div class="row">
                    @foreach ($counters as $counter)
                        <div class="col-md-3 col-sm-6 ts-facts">
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp"
                                        data-count="{{ $counter->value }}">0</span>
                                </h2>
                                <h3 class="ts-facts-title">{{ $counter->title }}</h3>
                            </div>
                        </div><!-- Col end -->
                    @endforeach

                </div> <!-- Facts end -->
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section><!-- Facts end -->

    {{-- services --}}
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
                                @if ($service->image)
                                    <img loading="lazy" src="{{ asset('storage/' . $service->image) }}"
                                        alt="{{ $service->title }}" />
                                @else
                                    <img loading="lazy" src="{{ asset('static/images/icon-image/placeholder_icon.png') }}"
                                        alt="service-icon" />
                                @endif
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a
                                        href="{{ route('frontend.services.detail', $service) }}">{{ $service->title }}</a>
                                </h3>
                                <p>{{ $service->excerpt }}</p>
                            </div>
                        </div><!-- Service item end -->
                    @endforeach
                </div><!-- Col end -->

                <div class="col-lg-6">
                    @foreach ($services->slice(ceil($services->count() / 2)) as $service)
                        <div class="ts-service-box d-flex mb-4">
                            <div class="ts-service-box-img">
                                <img loading="lazy" src="{{ asset('storage/' . $service->image) }}"
                                    alt="{{ $service->title }}" />
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a
                                        href="{{ route('frontend.services.detail', $service) }}">{{ $service->title }}</a>
                                </h3>
                                <p>{{ $service->excerpt }}</p>
                            </div>
                        </div><!-- Service item end -->
                    @endforeach
                </div><!-- Col end -->
            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Service end -->

    {{-- portfolios --}}
    <section id="main-container" class="main-container solid-bg">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-title">{{ $cms_setting['section_project']['text_main'] }}</h2>
                    <h3 class="section-sub-title">{{ $cms_setting['section_project']['text_secondary'] }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="shuffle-btn-group">
                        <label class="{{ !$current_category ? 'active' : '' }}" for="all">
                            <input type="radio" name="shuffle-filter" id="all" value="all" checked="checked">Show All
                        </label>
                        @foreach($project_categories as $category)
                        <label for="{{ $category->slug }}">
                            <input type="radio" name="shuffle-filter" id="{{ $category->slug }}"
                                value="{{ $category->slug }}" {{ $current_category && $current_category->slug ==
                            $category->slug ? 'checked' : '' }}>
                            {{ $category->title }}
                        </label>
                        @endforeach
                    </div><!-- project filter end -->

                    <div class="row shuffle-wrapper">
                        @foreach($projects as $project)
                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups='["@foreach($project->categories as $category){{ $category->slug }}{{ !$loop->last ? '", "' : '' }}@endforeach"]'>
                            <div class="project-img-container">
                                <a class="gallery-popup" href="{{ asset('storage/'. $project->thumbnail) }}">
                                    <img class="img-fluid" src="{{ asset('storage/'. $project->thumbnail) }}"
                                        alt="project-image">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a
                                                href="{{ route('frontend.projects.single', ['project' => $project->slug]) }}">{{
                                                $project->title }}</a>
                                        </h3>
                                        <p class="project-cat">
                                            @foreach ($project->categories as $category)
                                            {{ $category->title }}
                                            @if (!$loop->last), @endif
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- shuffle end -->

                </div>


            </div><!-- Content row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->

    {{-- testimonial --}}
    @include('layouts._frontend._partials.testimonials')

    <section class="subscribe no-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="subscribe-call-to-acton">
                        <h3>Can We Help?</h3>
                        <h4>{{ $opt_contact['phone'] }}</h4>
                    </div>
                </div><!-- Col end -->

                <div class="col-lg-8">
                    <div class="ts-newsletter row align-items-center">
                        <div class="col-md-5 newsletter-introtext">
                            <h4 class="text-white mb-0">Subscribe Us</h4>
                            <p class="text-white">Latest updates and news</p>
                        </div>

                        <div class="col-md-7 newsletter-form">
                            <form action="{{ route('frontend.subscriber.store') }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email address" name="email">

                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Subscribe</button>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div><!-- Newsletter end -->
                </div><!-- Col end -->

            </div><!-- Content row end -->
        </div>
        <!--/ Container end -->
    </section>
    <!--/ subscribe end -->

    <section id="news" class="news">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">{{ $cms_setting['section_news']['text_main'] }}</h2>
                    <h3 class="section-sub-title">{{ $cms_setting['section_news']['text_secondary'] }}</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                @foreach ($recentPosts as $post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="{{ route('frontend.news.single', ['news' => $post->slug]) }}"
                                    class="latest-post-img">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ asset('storage/' . $post->thumbnail) }}" alt="img">
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="{{ route('frontend.news.single', ['news' => $post->slug]) }}"
                                        class="d-inline-block">
                                        {{ $post->title }}
                                    </a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->
                @endforeach
            </div>
            <!--/ Content row end -->

            <div class="general-btn text-center mt-4">
                <a class="btn btn-primary" href="{{ route('frontend.news.index') }}">See All Posts</a>
            </div>

        </div>
        <!--/ Container end -->
    </section>

    @if (isset($opt_ads['ad_footer']) && $opt_ads['ad_footer']['ad_status'] == 'enable')
        {{-- Iklan di footer --}}
        <div class="container">
            <div class="text-center footer-ad mb-5">
                {{-- Menambahkan kelas img-fluid pada elemen <img> --}}
                {!! str_replace('<img', '<img class="img-fluid"', $opt_ads['ad_footer']['ad_code']) !!}
            </div>
        </div>
    @endif

@endsection

@push('css')
    <style>
        @media (max-width:768px) {
            .ts-service-box .ts-service-box-info {
                margin-bottom: 20px !important;
            }
        }
    </style>
@endpush

@push('css')
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('static/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/slick/slick-theme.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('static/plugins/animate-css/animate.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('static/plugins/colorbox/colorbox.css') }}">
@endpush

@push('js')
    <!-- Slick Carousel -->
    <script src="{{ asset('static/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('static/plugins/slick/slick-animation.min.js') }}"></script>
    <!-- Color box -->
    <script src="{{ asset('static/plugins/colorbox/jquery.colorbox.js') }}"></script>
    <!-- shuffle -->
    <script src="{{ asset('static/plugins/shuffle/shuffle.min.js') }}" defer></script>
@endpush
