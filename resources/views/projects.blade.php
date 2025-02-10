@extends('layouts.frontend')

@section('title', 'Projects - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'Projects - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_project']['keywords'])
@section('meta_description', $seo_setting['seo_project']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
<!--/ Header end -->
<div id="banner-area" class="banner-area" style="background-image:url({{ $cms_setting['section_project']['image'] ? asset('storage/' . $cms_setting['section_project']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">Projects</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Projects</li>
                            </ol>
                        </nav>
                    </div>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Banner text end -->
</div><!-- Banner area end -->

@if (count($projects))
<section id="main-container" class="main-container">
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
                <div class="col-lg-3 col-md-6 mb-5">
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

@else
@include('layouts._frontend._partials.404')
@endif


@endsection

@push('css')
<!-- Animation -->
<link rel="stylesheet" href="{{ asset('static/plugins/animate-css/animate.css') }}">
<!-- slick Carousel -->
<link rel="stylesheet" href="{{ asset('static/plugins/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('static/plugins/slick/slick-theme.css') }}">
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
