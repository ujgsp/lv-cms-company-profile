@extends('layouts.frontend')

@section('title', 'Contact - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'Contact - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_homepage']['keywords'])
@section('meta_description', $seo_setting['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
<div id="banner-area" class="banner-area"
    style="background-image:url({{ $cms_setting['section_contact']['image'] ? asset('storage/' . $cms_setting['section_contact']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">Contact</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
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

        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">{{ $cms_setting['section_contact']['text_main'] }}</h2>
                <h3 class="section-sub-title">{{ $cms_setting['section_contact']['text_secondary'] }}</h3>
            </div>
        </div>
        <!--/ Title row end -->

        <div class="row">
            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
                    <span class="ts-service-icon icon-round">
                        <i class="fas fa-map-marker-alt mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Visit Our Office</h4>
                        <p>{{ $opt_contact->address }}</p>
                    </div>
                </div>
            </div><!-- Col 1 end -->

            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
                    <span class="ts-service-icon icon-round">
                        <i class="fa fa-envelope mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Email Us</h4>
                        <p>{{ $opt_contact->email }}</p>
                    </div>
                </div>
            </div><!-- Col 2 end -->

            <div class="col-md-4">
                <div class="ts-service-box-bg text-center h-100">
                    <span class="ts-service-icon icon-round">
                        <i class="fa fa-phone-square mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4>Call Us</h4>
                        <p>{{ $opt_contact->phone }}</p>
                    </div>
                </div>
            </div><!-- Col 3 end -->

        </div><!-- 1st row end -->

        @if (!empty($opt_contact->maps))
        <div class="gap-60"></div>

        <div class="google-map">
            {{-- <div id="map" class="map" data-latitude="40.712776" data-longitude="-74.005974"
                data-marker="images/marker.png" data-marker-name="Constra"></div> --}}

            <div id="map" class="map">
                {!! $opt_contact->maps !!}
            </div>
        </div>
        @endif

        <div class="gap-40"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="section-title">{{ $cms_setting['section_get_in_touch']['text_main'] }}</h2>
                        <h3 class="section-sub-title">{{ $cms_setting['section_get_in_touch']['text_secondary'] }}</h3>
                    </div>
                </div>

                <!-- alert -->
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="alert-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form id="contact-form" action="{{ route('frontend.contact.store') }}" method="post" role="form">
                    @csrf
                    <div class="error-container"></div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control form-control-name @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}" type="text">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control form-control-email @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email') }}" type="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input class="form-control form-control-subject @error('phone') is-invalid @enderror"
                                    name="phone" id="phone" value="{{ old('phone') }}">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Subject <span class="text-danger">*</span></label>
                                <input class="form-control form-control-subject @error('subject') is-invalid @enderror"
                                    name="subject" id="subject" value="{{ old('subject') }}">

                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-message @error('message') is-invalid @enderror"
                            name="message" id="message" placeholder="" rows="10">{{ old('message') }}</textarea>

                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if ($opt_api['status'] == 'enable')
                    {{-- reCAPTCHA --}}
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ $opt_api['site_key'] }}"></div>
                        @error('g-recaptcha-response')
                        <span class="invalid-feedback" role="alert" style="display: block;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif

                    <div class="text-right"><br>
                        <button class="btn btn-primary solid blank d-block d-md-inline-block" type="submit">Send
                            Message</button>
                    </div>
                </form>
            </div>

        </div><!-- Content row -->
    </div><!-- Conatiner end -->
</section><!-- Main container end -->
{{-- Load reCAPTCHA script --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@push('css')
<style>
    .google-map iframe {
        width: 100%;
        height: 450px;
        border: none;
    }

    .form-control {
        background: #eeeeee;
        color: #0e314c;
    }

    /* Ensure proper display of button in different screen sizes */
    @media (max-width: 767.98px) {
        .btn-block {
            display: block;
            width: 100%;
        }
    }
</style>
@endpush
