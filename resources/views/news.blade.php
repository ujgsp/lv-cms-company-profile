@extends('layouts.frontend')

@section('title', 'News - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'News - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_news']['keywords'])
@section('meta_description', $seo_setting['seo_news']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
{{-- <div id="banner-area" class="banner-area" style="background-image:url({{ asset('storage/' . $cms_setting['section_news']['image']) }})"> --}}
<div id="banner-area" class="banner-area" style="background-image:url({{ $cms_setting['section_news']['image'] ? asset('storage/' . $cms_setting['section_news']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">News</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">News</li>
                            </ol>
                        </nav>
                    </div>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Banner text end -->
</div><!-- Banner area end -->

<section id="main-container" class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                @include('layouts._frontend._partials.news-list')
            </div><!-- Content Col end -->

            <div class="col-lg-4">
                @include('layouts._frontend._partials.news-sidebar')
            </div><!-- Sidebar Col end -->
        </div><!-- Main row end -->
    </div><!-- Container end -->
</section><!-- Main container end -->
@endsection

@push('css')
<style>
    .post-meta .post-meta-date {
        border-right: 0;
    }

</style>
@endpush
