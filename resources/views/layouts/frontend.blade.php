<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<!--
THEME: Constra - Construction Html5 Template
VERSION: 1.0.0
AUTHOR: Themefisher

HOMEPAGE: https://themefisher.com/products/constra-construction-template/
DEMO: https://demo.themefisher.com/constra/
GITHUB: https://github.com/themefisher/Constra-Bootstrap-Construction-Template

WEBSITE: https://themefisher.com
TWITTER: https://twitter.com/themefisher
FACEBOOK: https://www.facebook.com/themefisher
-->

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- Mobile Specific Metas -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <!-- Meta tags -->
    <meta name="author" content="Relitcode">
    <meta name="publisher" content="Relitcode">
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <meta property="og:title" content="@yield('meta_title', '')">
    <meta property="og:image" content="@yield('og_image', '')">
    <meta property="og:description" content="@yield('meta_description', '')">
    <link rel="image_src" href="@yield('og_image', '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $opt_site->favicon) }}">

    <!-- CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('static/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('static/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('static/plugins/animate-css/animate.css') }}">

    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">

    {{-- custom --}}
    <link rel="stylesheet" href="{{ asset('static/css/custom.css') }}">

    @stack('css')

    <style>
        /* css custom for ads pop */
        .ad-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }

        .ad-popup-content {
            background-color: white;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            max-width: 80%;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            border: none;
            background: none;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        /*-------------------------
    Preloader Css
---------------------------*/
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 9999999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preloader.hide {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
    </style>

</head>

<body>
    <div class="preloader" id="preloader"
        style="background: url({{ asset('static/images/other/1564905249loader.gif') }}) no-repeat scroll center center #FFF;">
    </div>

    <div class="body-inner">
        <!--/ Topbar start -->
        <div id="top-bar" class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <ul class="top-info text-center text-md-left">
                            <li><i class="fas fa-map-marker-alt"></i>
                                <p class="info-text">{{ $opt_contact->address }}</p>
                            </li>
                        </ul>
                    </div>
                    <!--/ Top info end -->

                    <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
                        <ul class="list-unstyled">
                            <li>
                                <a title="Facebook" href="{{ $site_info['facebook'] }}">
                                    <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                                </a>
                                <a title="Twitter" href="{{ $site_info['twitter'] }}">
                                    <span class="social-icon"><i class="fab fa-twitter"></i></span>
                                </a>
                                <a title="Instagram" href="{{ $site_info['instagram'] }}">
                                    <span class="social-icon"><i class="fab fa-instagram"></i></span>
                                </a>
                                <a title="Linkdin" href="{{ $site_info['linkedin'] }}">
                                    <span class="social-icon"><i class="fab fa-linkedin"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ Top social end -->
                </div>
                <!--/ Content row end -->
            </div>
            <!--/ Container end -->
        </div>

        <!-- Header start -->
        {{-- @include('layouts._frontend.navbar') --}}

        {{-- Pilih navbar berdasarkan data JSON --}}
        @if ($navbarConfig['navbar'] == 'default')
            @include('layouts._frontend.navbar')
        @elseif($navbarConfig['navbar'] == '02')
            @include('layouts._frontend.navbar-02')
        @endif
        <!--/ Header end -->

        {{-- content --}}
        @yield('content')

        @include('layouts._frontend.footer')

        <!-- Javascript Files ================================================== -->

        <!-- initialize jQuery Library -->
        {{-- <script src="{{ asset('static/plugins/jQuery/jquery.min.js') }}"></script> --}}
        <!-- jquery -->
        <script src="{{ asset('static/plugins/jQuery/jquery.js') }}"></script>
        <!-- Bootstrap jQuery -->
        <script src="{{ asset('static/plugins/bootstrap/bootstrap.min.js') }}" defer></script>

        <!-- Template custom -->
        <script src="{{ asset('static/js/script.js') }}"></script>

        @stack('js')

    </div><!-- Body inner end -->
</body>

</html>
@if (isset($opt_ads['ad_pop']) && $opt_ads['ad_pop']['ad_status'] == 'enable')
    <div id="adPopUp" class="ad-popup">
        <div class="ad-popup-content">
            <button id="closeAdPopUp" class="close">&times;</button>
            <div>
                {!! str_replace('<img', '<img class="img-fluid"', $opt_ads['ad_pop']['ad_code']) !!}
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var adPopup = document.getElementById('adPopUp');
            if (adPopup) {
                adPopup.style.display = 'flex';
            }
        }, 3000);

        var closeAdButton = document.getElementById('closeAdPopUp');
        if (closeAdButton) {
            closeAdButton.addEventListener('click', function() {
                document.getElementById('adPopUp').style.display = 'none';
            });
        }
    });
</script>

<script>
    $(function($) {
        "use strict";

        $(window).on('load', function() {

            /*---------------------
                Preloader
            -----------------------*/
            var preLoder = $("#preloader");
            preLoder.addClass('hide'); // Menambahkan class 'hide' untuk menyembunyikan preloader


        });
    });
</script>
