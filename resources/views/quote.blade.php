@extends('layouts.frontend')

@section('title', 'Get A Quote - ' . $site_setting['website_name'])

{{-- meta & og_image here --}}
@section('meta_title', 'Get A Quote - ' . $site_setting['website_name'])
@section('meta_keywords', $seo_setting['seo_homepage']['keywords'])
@section('meta_description', $seo_setting['seo_homepage']['description'])
@section('og_image', asset('storage/' . $seo_setting['open_graph_image']))

@section('content')
<div id="banner-area" class="banner-area"
    style="background-image:url({{ $cms_setting['section_quote']['image'] ? asset('storage/' . $cms_setting['section_quote']['image']) : asset('storage/' . $cms_setting['default_banner']['image']) }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">Get A Quote</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Get A Quote</li>
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
                <h3 class="section-sub-title">
                    {{ $cms_setting['section_quote']['text_main'] }}
                </h3>
            </div>

            <div class="col-12">
                {{-- alert here --}}

                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif

                {{-- @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="alert-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif --}}
            </div>
        </div>

        <div class="gap-40"></div>

        <div class="row">

            <div class="col-md-12">
                <h2 class="section-title">
                    {{ $cms_setting['section_quote']['text_secondary'] }}
                </h2> <br>

                <form id="contact-form" action="{{ route('frontend.getQuote.store') }}" method="post" role="form">
                    @csrf
                    <div class="error-container"></div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control form-control-name @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="" type="text" value="{{ old('name') }}">
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
                                    name="email" id="email" placeholder="" type="email" value="{{ old('email') }}">
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
                                    name="phone" id="phone" placeholder="" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Company (Optional)</label>
                                <input class="form-control form-control-subject" name="company" id="company"
                                    placeholder="" value="{{ old('company') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input class="form-control form-control-subject @error('address') is-invalid @enderror"
                                    name="address" id="address" placeholder="" value="{{ old('address') }}">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <input class="form-control form-control-subject @error('city') is-invalid @enderror"
                                    name="city" id="city" placeholder="" value="{{ old('city') }}">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">What do you prefer for contact? <span
                                class="text-danger">*</span></label>
                        <div
                            class="custom-control custom-radio margin-bottom-30 @error('prefer_contact') is-invalid @enderror">
                            <input class="custom-control-input" type="radio" name="prefer_contact" value="phone"
                                id="pre_phone" {{ old('prefer_contact')=='phone' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="pre_phone">Phone</label>
                        </div>
                        <div
                            class="custom-control custom-radio margin-bottom-30 @error('prefer_contact') is-invalid @enderror">
                            <input class="custom-control-input" type="radio" name="prefer_contact" value="email"
                                id="pre_email" {{ old('prefer_contact')=='email' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="pre_email">Email</label>
                        </div>
                        @error('prefer_contact')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Services <span class="text-danger">*</span></label>
                        <select class="form-control @error('service_id') is-invalid @enderror" id="service_id"
                            name="service_id">
                            <option value="" selected disabled>Select a Service</option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id')==$service->id || (isset($serviceId)
                                && $serviceId == $service->id) ? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('service_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                        <button class="btn btn-primary solid blank d-block d-md-inline-block"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- Content row -->
    </div><!-- Container end -->
</section><!-- Main container end -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@push('css')
<style>
    .form-control {
        background: #eeeeee;
        color: #0e314c;
    }
</style>
@endpush
