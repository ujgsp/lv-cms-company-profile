@extends('layouts.frontend')

@section('title', $page->title . ' - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', $page->title . ' - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_homepage']['keywords'])
@section('meta_description', $seo_setting['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
    {{-- <div id="banner-area" class="banner-area" style="background-image:url({{ asset('static/images/banner/banner1.jpg') }})"> --}}
    <div id="banner-area" class="banner-area" style="background-image:url({{ asset('storage/' . $cms_setting['default_banner']['image']) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">{{ $page->title }}</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
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

            <div class="row">

                <div class="col-md-12">
                    <h3 class="column-title">{{ $page->title }}</h3>

                    {!! $page->body !!}

                </div>


            </div><!-- Content row 1 -->

        </div><!-- Container end -->
    </section>
@endsection
