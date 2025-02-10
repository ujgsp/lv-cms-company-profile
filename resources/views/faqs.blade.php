@extends('layouts.frontend')

@section('title', 'FAQs - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'FAQs - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_homepage']['keywords'])
@section('meta_description', $seo_setting['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
    <div id="banner-area"
         class="banner-area"
         style="background-image:url({{ $cms_setting['section_faq']['image'] ? asset('storage/' . $cms_setting['section_faq']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">FAQs</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active"
                                        aria-current="page">FAQs</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div>

    <section id="main-container"
             class="main-container">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">

                    @foreach ($categories as $category)
                        <h3 class="border-title border-left mar-t0">{{ $category->title }}</h3>

                        <div class="accordion accordion-group accordion-classic"
                             id="category-{{ $category->id }}-accordion">
                            @foreach ($category->faqs as $faq)
                                <div class="card">
                                    <div class="card-header p-0 bg-transparent"
                                         id="heading{{ $faq->id }}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-left {{ $loop->first ? '' : 'collapsed' }}"
                                                    type="button"
                                                    data-toggle="collapse"
                                                    data-target="#collapse{{ $faq->id }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $faq->id }}">
                                                {{ $faq->title }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse{{ $faq->id }}"
                                         class="collapse {{ $loop->first ? 'show' : '' }}"
                                         aria-labelledby="heading{{ $faq->id }}"
                                         data-parent="#category-{{ $category->id }}-accordion">
                                        <div class="card-body">
                                            {!! $faq->body !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--/ Accordion end -->

                        <div class="gap-40"></div>
                    @endforeach

                </div><!-- Col end -->

                <div class="col-lg-4 mt-5 mt-lg-0">

                    <div class="sidebar sidebar-right">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="list-unstyled">
                                @foreach ($recentPosts as $post)
                                    <li class="d-flex align-items-center">
                                        <div class="posts-thumb">
                                            <a href="{{ route('frontend.news.single', $post->slug) }}">
                                                <img loading="lazy"
                                                     alt="{{ $post->title }}"
                                                     src="{{ asset('storage/' . $post->thumbnail) }}">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <h4 class="entry-title">
                                                <a
                                                   href="{{ route('frontend.news.single', $post->slug) }}">{{ $post->title }}</a>
                                            </h4>
                                        </div>
                                    </li><!-- Post end-->
                                @endforeach

                            </ul>

                        </div><!-- Recent post end -->

                        @if (isset($opt_ads['ad_middle']) && $opt_ads['ad_middle']['ad_status'] == 'enable')
                            {{-- Iklan di tengah halaman --}}
                            <div class="widget mt-3">
                                {{-- Menambahkan kelas img-fluid pada elemen <img> --}}
                                {!! str_replace('<img', '<img class="img-fluid"', $opt_ads['ad_middle']['ad_code']) !!}
                            </div>
                        @endif

                    </div><!-- Sidebar end -->

                </div><!-- Col end -->

            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->
@endsection
