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

    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-area">
                        <div class="row">
                            @foreach ($usps as $usp)
                                <!-- Feature Item -->
                                <div class="{{ count($usps) > 6 ? 'col-lg-4' : 'col-lg-6' }} col-md-6">
                                    <a href="javascript:void(0)" class="single-feature d-flex align-items-stretch">
                                        <div class="icon mb-3">
                                            <img src="{{ asset('storage/' . $usp->image) }}" alt="">
                                        </div>
                                        <div class="content flex-grow-1">
                                            <h4 class="title text-capitalize">
                                                {{ $usp->title }}
                                            </h4>
                                            <p class="text">
                                                {{ $usp->description }}
                                            </p>
                                            <span class="link">
                                                <i class="fas fa-angle-double-right"></i>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('storage/' . $opt_about_us['thumbnail']) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-self-center">
                    <div class="about-content">
                        <div class="section-heading">

                            <h2 class="title extra-padding">
                                About US</h2>

                        </div>
                        <div class="content">
                            {{ $opt_about_us['short_description'] }}
                            <div class="general-btn">
                                <a class="btn btn-primary" href="#about">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- masih data static --}}
    <section class="statistic"
        style="background: url({{ $cms_setting['section_statistic']['image'] ? asset('storage/' . $cms_setting['section_statistic']['image']) : asset('static/images/banner/banner4.jpg') }});"
        id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading color-white text-left">
                        <h5 class="sub-title">
                            {{ $cms_setting['section_statistic']['text_main'] }}
                        </h5>
                        <h2 class="title">
                            {{ $cms_setting['section_statistic']['text_secondary'] }}
                        </h2>
                        <p class="text">
                            {{ $cms_setting['section_statistic']['text_description'] }}
                        </p>
                        <div class="general-btn">
                            <a class="btn btn-primary" href="{{ route('frontend.getQuote.index') }}">Get a Quote</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($counters as $counter)
                                <div class="col-md-6">
                                    <div class="single-statistic">
                                        <div class="icon" style="font-size: 40px">
                                            {{ $counter['value'] }}
                                        </div>
                                        <p class="text">
                                            {{ $counter['title'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="service">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-heading">
                        <h5 class="sub-title">
                            {{ $cms_setting['section_service']['text_main'] }}
                        </h5>
                        <h2 class="title">
                            {{ $cms_setting['section_service']['text_secondary'] }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                    <div class="{{ count($services) > 6 ? 'col-lg-4' : 'col-lg-6' }} col-md-6">
                        <a href="{{ route('frontend.services.detail', $service) }}">
                            <div class="single-service">
                                <div class="icon">
                                    @if ($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}"
                                            alt="{{ $service->title }}" />
                                    @else
                                        <img src="{{ asset('static/images/icon-image/placeholder_icon.png') }}"
                                            alt="service-icon" />
                                    @endif
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        {{ $service->title }}
                                    </h4>
                                    <p>
                                        <span
                                            style="color: rgb(5, 14, 51); text-align: center;">{{ $service->excerpt }}</span><br>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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
                                        placeholder="Email address" name="email" required>

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

    <section class="gallery">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="section-heading">
                        <h5 class="sub-title">
                            {{ $cms_setting['section_project']['text_main'] }}
                        </h5>
                        <h2 class="title">
                            {{ $cms_setting['section_project']['text_secondary'] }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="gallery-slider">
                        @foreach ($projects as $project)
                            <div class="item">
                                <a href="{{ route('frontend.projects.single', ['project' => $project->slug]) }}"
                                    class="single-project">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="">
                                    </div>
                                    <div class="content">
                                        <p class="sub-title">
                                            Latest project
                                        </p>
                                        <h4 class="title">
                                            {{ $project->title }}
                                        </h4>
                                        <span class="link">
                                            <i class="fas fa-angle-double-right"></i>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- testimonial --}}
    @include('layouts._frontend._partials.testimonials')

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

@endsection

@push('css')
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('static/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/addition.css') }}">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('static/css/plugin.css') }}">

    {{-- <!-- Plugin css -->
    <link rel="stylesheet" href="https://products.geniusocean.com/industry-pro/assets/front/css/plugin.css">

    <!-- responsive -->
    <link rel="stylesheet" href="https://products.geniusocean.com/industry-pro/assets/front/css/responsive.css">

    <style>
        /* homepage2 */
        /*-------------------------------Features Area CSS Start--------------------------------*/
        .features {
            padding: 0px 0px 10px;
            margin-top: -90px;
            position: relative;
            z-index: 1;
        }

        .single-feature {
            padding: 30px 30px 30px 30px;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            -webkit-box-shadow: 0px 3px 10px 0px rgba(134, 135, 143, 0.1);
            box-shadow: 0px 3px 10px 0px rgba(134, 135, 143, 0.1);
        }

        .single-feature::before {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            background: #fff;
            top: 0;
            left: 0;
            z-index: -9;
        }

        .single-feature .icon {
            display: inline-block;
            width: 40px;
            margin-right: 20px;
        }

        .single-feature .icon img {
            width: auto;
            max-width: 40px;
        }

        .single-feature .content {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        .single-feature .content .title {
            font-size: 20px;
            line-height: 28px;
            font-weight: 600;
            margin-bottom: 5px;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .single-feature .content .text {
            font-size: 16px;
            margin-bottom: 0px;
        }

        .single-feature .content .link {
            position: absolute;
            right: -20px;
            bottom: -20px;
            width: 70px;
            height: 70px;
            background: #ff5e14;
            padding-left: 17px;
            padding-top: 13px;
            color: #fff;
            font-size: 20px;
            border-radius: 50%;
        }

        .single-feature .content::before {
            position: absolute;
            content: "";
            width: 70px;
            height: 70px;
            background: rgba(255, 94, 20, 0.2);
            right: -20px;
            bottom: -20px;
            border-radius: 50%;
            z-index: -1;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .single-feature:hover {
            -webkit-transform: translateY(-5px);
            -ms-transform: translateY(-5px);
            transform: translateY(-5px);
            -webkit-box-shadow: 0px 13px 15px 0px rgba(134, 135, 143, 0.12);
            box-shadow: 0px 13px 15px 0px rgba(134, 135, 143, 0.12);
        }

        .single-feature:hover .content::before {
            position: absolute;
            content: "";
            width: 200px;
            height: 200px;
            background: rgba(255, 94, 20, 0.1);
            right: -25px;
            bottom: -25px;
            border-radius: 50%;
        }

        /*-------------------------------Features  Area CSS End--------------------------------*/
        /*-------------------------------About Area CSS Start--------------------------------*/
        .about {
            padding: 50px 0px 70px;
            display: block;
            position: relative;
        }

        .about .about-img img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .about .about-content {
            padding-left: 30px;
        }

        .about .section-heading {
            text-align: left;
            margin-bottom: 20px;
        }

        .about .section-heading .sub-title {
            font-size: 18px;
            font-weight: 600;
            color: #17222C;
            margin-bottom: 10px;
        }

        .about .section-heading .title {
            font-size: 36px;
            font-weight: 700;
            color: #17222C;
            line-height: 1.2;
        }

        .about .content p {
            color: #17222C;
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.8;
        }

        .about .about-content .mybtn1 {
            margin-top: 20px;
            padding: 10px 30px;
            background-color: #ff5e14;
            color: #fff;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .about .about-content .mybtn1:hover {
            background-color: #e04e0f;
            color: #fff;
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .about .about-content {
                padding-left: 0;
                text-align: center;
            }

            .about .about-img {
                margin-bottom: 30px;
            }

            .about .section-heading .title {
                font-size: 28px;
                line-height: 1.3;
            }

            .about .section-heading .sub-title {
                font-size: 16px;
            }
        }

        /*-------------------------------About Area CSS End--------------------------------*/
        /*-------------------------------Statistic Area Start--------------------------------*/
        .statistic {
            background: url(../images/statistic.jpg);
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            padding: 70px 0px 40px;
        }

        .statistic .section-heading .mybtn1 {
            margin-top: 23px;
        }

        .statistic .single-statistic {
            background: #fff;
            text-align: center;
            padding: 30px 20px 25px;
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .statistic .single-statistic::before {
            position: absolute;
            content: "";
            left: 0px;
            bottom: 0px;
            width: 0%;
            height: 5px;
            background: #ff5e14;
            z-index: 9;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .statistic .single-statistic:hover::before {
            width: 100%;
        }

        .statistic .single-statistic .icon {
            display: inline-block;
            margin-bottom: 15px;
        }

        .statistic .single-statistic .text {
            font-weight: 600;
            margin-bottom: 0px;
        }

        .statistic .single-statistic:hover {
            -webkit-transform: translateY(-7px);
            -ms-transform: translateY(-7px);
            transform: translateY(-7px);
        }

        .section-heading {
            text-align: center;
            position: relative;
        }

        .section-heading.color-white .sub-title {
            color: #fff;
        }

        .section-heading.color-white .title {
            color: #fff;
        }

        .section-heading.color-white .text {
            color: #fff;
        }

        /*-------------------------------Statistic Area End--------------------------------*/
        /*-------------------------------Service Area CSS Start--------------------------------*/
        /* .service {
                padding: 63px 0px 40px;
            }

            .service .section-heading {
                margin-bottom: 40px;
            }

            .single-service {
                background: #fff;
                border: 1px solid rgba(255, 94, 20, 0);
                margin-bottom: 30px;
                padding: 30px 20px 27px;
                -webkit-transition: all 0.3s ease-in;
                -o-transition: all 0.3s ease-in;
                transition: all 0.3s ease-in;
                -webkit-box-shadow: 0px 4px 3px 0px rgba(230, 230, 230, 0.71);
                box-shadow: 0px 4px 3px 0px rgba(230, 230, 230, 0.71);
                text-align: center;
                transition: all 0.3s ease-in;
            }

            .single-service .icon img {
                width: auto;
                display: inline-block;
            }

            .single-service .content .title {
                font-size: 20px;
                font-weight: 600;
                margin: 20px 0px 18px;
                -webkit-transition: all 0.3s ease-in;
                -o-transition: all 0.3s ease-in;
                transition: all 0.3s ease-in;
            }

            .single-service .content p {
                font-size: 16px;
                margin-bottom: 0px;
            }

            .single-service:hover {
                -webkit-box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.08);
                box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.08);
                -webkit-transform: translateY(-5px);
                -ms-transform: translateY(-5px);
                transform: translateY(-5px);
            }

            .single-service:hover .content .title {
                color: #ff5e14;
            } */
        .service {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-heading .sub-title {
            color: #ff7a59;
            font-weight: 600;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .section-heading .title {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .section-heading .text {
            color: #555;
            font-size: 16px;
            margin-top: 20px;
        }

        .single-service {
            background-color: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            text-align: center;
            padding: 30px 20px;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .single-service:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .single-service .icon {
            margin-bottom: 20px;
        }

        .single-service .icon img {
            width: 60px;
            height: auto;
        }

        .single-service .title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .single-service p {
            color: #777;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .service {
                padding: 40px 0;
            }

            .section-heading .title {
                font-size: 28px;
            }

            .single-service {
                padding: 20px 15px;
            }

            .single-service .title {
                font-size: 18px;
            }
        }

        /*-------------------------------
                Service Area CSS End
              --------------------------------*/
        /*-------------------------------
            Submit Address Area Start
            --------------------------------*/
        .submit-address {
            padding: 126px 0px 102px;
            background: url(../images/address-submit.jpg);
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: cover !important;
            text-align: center;
        }

        .submit-address .title {
            font-size: 30px;
            line-height: 38px;
            font-weight: 700;
            color: #fff;
            text-align: left;
            margin-bottom: 15px;
        }

        .submit-address .text {
            text-align: left;
            color: #fff;
        }

        .submit-address .j-end {
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: end;
        }

        .submit-address .mybtn2 {
            margin-left: auto;
        }

        /*-------------------------------
              Submit Address Area End
              --------------------------------*/
        /*-----------------------------
              Latest Project Area Start
            -----------------------------*/
        .gallery {
            padding: 70px 0px 150px;
        }

        .gallery .section-heading {
            margin-bottom: 67px;
        }

        .gallery .single-project {
            position: relative;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .gallery .single-project .link {
            position: absolute;
            right: -20px;
            bottom: -20px;
            width: 70px;
            height: 70px;
            background: #ff5e14;
            padding-left: 17px;
            padding-top: 13px;
            color: #fff;
            font-size: 20px;
            border-radius: 50%;
            opacity: 0;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .gallery .single-project .content {
            position: absolute;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.8);
            width: 100%;
            height: 100%;
            padding: 25px 30px 30px;
            opacity: 0;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        .gallery .single-project .content .sub-title {
            color: #fff;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .gallery .single-project .content .title {
            font-weight: 600;
            color: #fff;
        }

        .gallery .single-project:hover .link {
            opacity: 1;
        }

        .gallery .single-project:hover .content {
            opacity: 1;
        }

        .gallery .gallery-slider.owl-carousel .owl-item {
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            -webkit-box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.1);
        }

        .gallery .gallery-slider.owl-carousel .owl-item.active.center {
            -webkit-transform: translateY(-30px);
            -ms-transform: translateY(-30px);
            transform: translateY(-30px);
        }

        .gallery .owl-carousel .owl-stage-outer {
            overflow: visible;
        }

        .gallery .owl-carousel.owl-theme .owl-controls .owl-nav div.owl-prev,
        .gallery .owl-carousel.owl-theme .owl-controls .owl-nav div.owl-next {
            color: #fff;
            font-size: 16px;
            position: absolute;
            bottom: -80px;
            text-align: center;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            opacity: 1;
            background: #ff5e14;
            -webkit-box-shadow: 0px 8px 15px 0px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 8px 15px 0px rgba(0, 0, 0, 0.2);
        }

        .gallery .owl-carousel.owl-theme .owl-controls .owl-nav div.owl-prev:hover,
        .gallery .owl-carousel.owl-theme .owl-controls .owl-nav div.owl-next:hover {
            background-color: white;
            color: #ff5e14;
            -webkit-box-shadow: 0px 8px 15px 0px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 8px 15px 0px rgba(0, 0, 0, 0.2);
        }

        .gallery .owl-carousel.owl-theme .owl-controls .owl-nav div.owl-prev {
            left: 50%;
            margin-left: -50px;
            -webkit-transition: all linear .3s;
            -o-transition: all linear .3s;
            transition: all linear .3s;
        }

        .gallery .owl-carousel.owl-theme .owl-controls .owl-nav div.owl-next {
            right: 50%;
            margin-right: -50px;
            -webkit-transition: all linear .3s;
            -o-transition: all linear .3s;
            transition: all linear .3s;
        }

        .gallery .owl-carousel.owl-theme:hover .owl-controls .owl-nav div.owl-prev,
        .gallery .owl-carousel.owl-theme:hover .owl-controls .owl-nav div.owl-next {
            opacity: 1;
        }

        /*-----------------------------
                  Latest Project Area End
                -----------------------------*/
    </style> --}}
@endpush

@push('js')
    <!-- Slick Carousel -->
    <script src="{{ asset('static/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('static/plugins/slick/slick-animation.min.js') }}"></script>
    <!-- Color box -->
    <script src="{{ asset('static/plugins/colorbox/jquery.colorbox.js') }}"></script>
    <!-- shuffle -->
    <script src="{{ asset('static/plugins/shuffle/shuffle.min.js') }}" defer></script>

    <!-- popper -->
    {{-- <script src="https://products.geniusocean.com/industry-pro/assets/front/js/popper.min.js"></script> --}}
    <!-- plugin js-->
    <script src="https://products.geniusocean.com/industry-pro/assets/front/js/plugin.js"></script>

    <!-- main -->
    <script src="https://products.geniusocean.com/industry-pro/assets/front/js/main.js"></script>
@endpush
