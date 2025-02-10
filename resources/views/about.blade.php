@extends('layouts.frontend')

@section('title', 'About Us - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'About Us - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_homepage']['keywords'])
@section('meta_description', $seo_setting['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
    {{-- <div id="banner-area" class="banner-area" style="background-image:url({{ asset('storage/' .$cms_setting['section_about_us']['image']) }})"> --}}
    <div id="banner-area" class="banner-area" style="background-image:url({{ $cms_setting['section_about_us']['image'] ? asset('storage/' . $cms_setting['section_about_us']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">About</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
                <div class="col-md-12">
                    <h3 class="column-title text-center">{{ $opt_about_us->title }}</h3>


                    @if ($opt_about_us->thumbnail)
                        <img class="d-block mb-3 mx-auto img-fluid rounded "
                            src="{{ asset('storage/' . $opt_about_us->thumbnail) }}" alt="">
                    @endif


                    {!! $opt_about_us->description !!}


                </div><!-- Col end -->


            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->


    {{-- counter --}}
    <section id="facts" class="facts-area dark-bg">
        <div class="container">
            <div class="facts-wrapper">
                <div class="row">
                    @foreach ($counters as $counter)
                        <div class="col-md-3 col-sm-6 ts-facts">
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="{{ $counter->value }}">0</span>
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

    <section id="ts-team" class="ts-team">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-title">Quality Service</h2>
                    <h3 class="section-sub-title">Professional Team</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="col-lg-12">
                    <div id="team-slide" class="team-slide">
                        @foreach ($members as $member)
                            <div class="item">
                                <div class="ts-team-wrapper">
                                    <div class="team-img-wrapper">
                                        @if ($member->image)
                                            <img loading="lazy" class="w-100"
                                                src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}">
                                        @else
                                            <img loading="lazy" class="w-100"
                                                src="{{ asset('static/images/team/default_user_2_optimize.png') }}"
                                                alt="team-img">
                                        @endif
                                    </div>
                                    <div class="ts-team-content">
                                        <h3 class="ts-name">{{ $member->name }}</h3>
                                        <p class="ts-designation">{{ $member->designation }}</p>
                                        <div class="team-social-icons">
                                            <a href="{{ !empty($member->facebook_url) ? $member->facebook_url : '#' }}"><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a href="{{ !empty($member->twitter_url) ? $member->twitter_url : '#' }}"><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="{{ !empty($member->instagram_url) ? $member->instagram_url : '#' }}"><i
                                                    class="fab fa-instagram"></i></a>
                                            <a href="{{ !empty($member->linkedin_url) ? $member->linkedin_url : '#' }}"><i
                                                    class="fab fa-linkedin"></i></a>
                                        </div>
                                        <!--/ social-icons-->
                                    </div>
                                </div>
                                <!--/ Team wrapper end -->
                            </div><!-- Team 1 end -->
                        @endforeach

                    </div><!-- Team slide end -->
                </div>
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section>
    <!--/ Team end -->
@endsection

@push('css')
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
