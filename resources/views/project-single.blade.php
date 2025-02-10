@extends('layouts.frontend')

@section('title', $project->title . ' - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', $project->title . ' - ' . $site_setting['website_name'])
@section('meta_description', $seo_setting['seo_project']['description'])
@section('og_image', asset('storage/' . $project->thumbnail))

@section('content')
    <!--/ Header end -->
    <div id="banner-area"
         class="banner-area"
         style="background-image:url({{ $cms_setting['section_project']['image'] ? asset('storage/' . $cms_setting['section_project']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">{{ $project->title }}</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active"
                                        aria-current="page">Project</li>
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
                <div class="col-lg-8">
                    <h3 class="border-title border-left mar-t0">{{ $project->title }}</h3>
                    <div class="item project-single">
                        <img loading="lazy"
                             class="img-fluid"
                             src="{{ asset('storage/' . $project->thumbnail) }}"
                             alt="project-image" />
                    </div>
                    <div class="">
                        {!! str_replace('<img ', '<img class="img-fluid rounded" ', $project->body) !!}
                    </div>
                </div><!-- Slider col end -->

                <div class="col-lg-4 mt-5 mt-lg-0">

                    <div class="sidebar sidebar-right">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">Project Info</h3>
                            {!! $project->project_info !!}
                        </div><!-- Recent post end -->

                        @if (isset($opt_ads['ad_middle']) && $opt_ads['ad_middle']['ad_status'] == 'enable')
                            {{-- Iklan di tengah halaman --}}
                            <div class="middle-ad"
                                 style="margin-left: 20px;">
                                {{-- Menambahkan kelas img-fluid pada elemen <img> --}}
                                {!! str_replace('<img', '<img class="img-fluid"', $opt_ads['ad_middle']['ad_code']) !!}
                            </div>
                        @endif

                    </div><!-- Sidebar end -->

                </div>
            </div><!-- Row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
