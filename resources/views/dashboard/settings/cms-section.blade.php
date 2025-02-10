@extends('dashboard.settings.index')

@section('content_settings')
    {{-- contact info --}}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">CMS Section Settings</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('settings.cms.update', ['option' => 'setting_section_cms']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">The recommended image size for the banner section is 1600 px by 300 px.
                        </div>

                        <!-- Default -->
                        <h3>Default Banner</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['default_banner']['image'])
                                <div class="image-preview">
                                    <img src="{{ asset('storage/' . $opt_cms['default_banner']['image']) }}"
                                        id="imageDefaultBanner" class="img-fluid rounded">
                                    <input type="hidden" name="imageDefaultBannerOld"
                                        value="{{ $opt_cms['default_banner']['image'] }}">
                                </div>
                            @else
                                <div class="image-preview">
                                    <img src="{{ asset('static-admin/img/photos/unsplash-4.jpg') }}" id="imageDefaultBanner"
                                        class="img-fluid rounded">
                                </div>
                            @endif

                            <input class="form-control" type="file" id="default_banner" name="default_banner"
                                onchange="previewFile(this, 'imageDefaultBanner');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <!-- ABOUT -->
                        <h3>About Us</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_about_us']['image'])
                                <div class="image-preview" id="showImage">
                                    <img src="{{ asset('storage/' . $opt_cms['section_about_us']['image']) }}"
                                        id="imageSectionAboutUs" class="img-fluid rounded">
                                    <input type="hidden" name="imageSectionAboutUsOld"
                                        value="{{ $opt_cms['section_about_us']['image'] }}">
                                </div>
                            @else
                                <div id="showImage"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_about_us"
                                name="section_image_about_us" onchange="previewFileAdd(this, 'showImage');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <!-- SERVICE -->
                        <h3>Service</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_service']['image'])
                                <div class="image-preview" id="showImageService">
                                    <img src="{{ asset('storage/' . $opt_cms['section_service']['image']) }}"
                                        id="imageSectionService" class="img-fluid">
                                    <input type="hidden" name="imageSectionServiceOld"
                                        value="{{ $opt_cms['section_service']['image'] }}">
                                </div>
                            @else
                            <div id="showImageService"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_service"
                                name="section_image_service" onchange="previewFileAdd(this, 'showImageService');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_service">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_service') is-invalid @enderror"
                                id="section_text_main_service" name="section_text_main_service"
                                value="{{ $opt_cms['section_service']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Service' section.</small>

                            @error('section_text_main_service')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_service">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_service') is-invalid @enderror"
                                id="section_text_secondary_service" name="section_text_secondary_service"
                                value="{{ $opt_cms['section_service']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Service' section.</small>

                            @error('section_text_secondary_service')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- PROJECT -->
                        <h3>Project</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_project']['image'])
                                <div class="image-preview" id="showImageProject">
                                    <img src="{{ asset('storage/' . $opt_cms['section_project']['image']) }}"
                                        id="imageSectionProject" class="img-fluid">
                                    <input type="hidden" name="imageSectionProjectOld"
                                        value="{{ $opt_cms['section_project']['image'] }}">
                                </div>
                            @else
                            <div id="showImageProject"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_project"
                                name="section_image_project" onchange="previewFileAdd(this, 'showImageProject');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_project">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_project') is-invalid @enderror"
                                id="section_text_main_project" name="section_text_main_project"
                                value="{{ $opt_cms['section_project']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Project' section.</small>

                            @error('section_text_main_project')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_project">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_project') is-invalid @enderror"
                                id="section_text_secondary_project" name="section_text_secondary_project"
                                value="{{ $opt_cms['section_project']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Project' section.</small>

                            @error('section_text_secondary_project')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- PRICING -->
                        <h3>Pricing</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_pricing']['image'])
                                <div class="image-preview" id="showImagePricing">
                                    <img src="{{ asset('storage/' . $opt_cms['section_pricing']['image']) }}"
                                        id="imageSectionPricing" class="img-fluid">
                                    <input type="hidden" name="imageSectionPricingOld"
                                        value="{{ $opt_cms['section_pricing']['image'] }}">
                                </div>
                            @else
                            <div id="showImagePricing"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_pricing"
                                name="section_image_pricing" onchange="previewFileAdd(this, 'showImagePricing');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_pricing">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_pricing') is-invalid @enderror"
                                id="section_text_main_pricing" name="section_text_main_pricing"
                                value="{{ $opt_cms['section_pricing']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Pricing' section.</small>

                            @error('section_text_main_pricing')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_pricing">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_pricing') is-invalid @enderror"
                                id="section_text_secondary_pricing" name="section_text_secondary_pricing"
                                value="{{ $opt_cms['section_pricing']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Pricing' section.</small>

                            @error('section_text_secondary_pricing')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- NEWS -->
                        <h3>News Article</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_news']['image'])
                                <div class="image-preview" id="showImageNews">
                                    <img src="{{ asset('storage/' . $opt_cms['section_news']['image']) }}"
                                        id="imageSectionNews" class="img-fluid">
                                    <input type="hidden" name="imageSectionNewsOld"
                                        value="{{ $opt_cms['section_news']['image'] }}">
                                </div>
                            @else
                            <div id="showImageNews"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_news" name="section_image_news"
                                onchange="previewFileAdd(this, 'showImageNews');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_news">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_news') is-invalid @enderror"
                                id="section_text_main_news" name="section_text_main_news"
                                value="{{ $opt_cms['section_news']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'news' section.</small>

                            @error('section_text_main_news')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_news">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_news') is-invalid @enderror"
                                id="section_text_secondary_news" name="section_text_secondary_news"
                                value="{{ $opt_cms['section_news']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'news'
                                section.</small>

                            @error('section_text_secondary_news')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- FAQS -->
                        <h3>FAQs</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_faq']['image'])
                                <div class="image-preview" id="showImageFaq">
                                    <img src="{{ asset('storage/' . $opt_cms['section_faq']['image']) }}"
                                        id="imageSectionFaq" class="img-fluid">
                                    <input type="hidden" name="imageSectionFaqOld"
                                        value="{{ $opt_cms['section_faq']['image'] }}">
                                </div>
                            @else
                            <div id="showImageFaq"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_faq" name="section_image_faq"
                                onchange="previewFileAdd(this, 'showImageFaq');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <!-- CONTACT -->
                        <h3>Contact</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_contact']['image'])
                                <div class="image-preview" id="showImageContact">
                                    <img src="{{ asset('storage/' . $opt_cms['section_contact']['image']) }}"
                                        id="imageSectionContact" class="img-fluid">
                                    <input type="hidden" name="imageSectionContactOld"
                                        value="{{ $opt_cms['section_contact']['image'] }}">
                                </div>
                            @else
                            <div id="showImageContact"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_contact"
                                name="section_image_contact" onchange="previewFileAdd(this, 'showImageContact');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_contact">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_contact') is-invalid @enderror"
                                id="section_text_main_contact" name="section_text_main_contact"
                                value="{{ $opt_cms['section_contact']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Contact' section.</small>

                            @error('section_text_main_contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_contact">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_contact') is-invalid @enderror"
                                id="section_text_secondary_contact" name="section_text_secondary_contact"
                                value="{{ $opt_cms['section_contact']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Contact'
                                section.</small>

                            @error('section_text_secondary_contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- GET IN TOUCH -->
                        <h3>Get In Touch</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_get_in_touch">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_get_in_touch') is-invalid @enderror"
                                id="section_text_main_get_in_touch" name="section_text_main_get_in_touch"
                                value="{{ $opt_cms['section_get_in_touch']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Get In Touch' section.</small>

                            @error('section_text_main_get_in_touch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_get_in_touch">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_get_in_touch') is-invalid @enderror"
                                id="section_text_secondary_get_in_touch" name="section_text_secondary_get_in_touch"
                                value="{{ $opt_cms['section_get_in_touch']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Get In Touch'
                                section.</small>

                            @error('section_text_secondary_get_in_touch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- GET FREE QUOTE -->
                        <h3>Quote</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_quote']['image'])
                                <div class="image-preview" id="showImageQuote">
                                    <img src="{{ asset('storage/' . $opt_cms['section_quote']['image']) }}"
                                        id="imageSectionQuote" class="img-fluid">
                                    <input type="hidden" name="imageSectionQuoteOld"
                                        value="{{ $opt_cms['section_quote']['image'] }}">
                                </div>
                            @else
                            <div id="showImageQuote"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_quote"
                                name="section_image_quote" onchange="previewFileAdd(this, 'showImageQuote');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_quote">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_quote') is-invalid @enderror"
                                id="section_text_main_quote" name="section_text_main_quote"
                                value="{{ $opt_cms['section_quote']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Quote' section.</small>

                            @error('section_text_main_quote')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_quote">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_quote') is-invalid @enderror"
                                id="section_text_secondary_quote" name="section_text_secondary_quote"
                                value="{{ $opt_cms['section_quote']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Quote'
                                section.</small>

                            @error('section_text_secondary_quote')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- WHY CHOOSE US -->
                        <h3>Why Choose Us</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_why_choose_us">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_why_choose_us') is-invalid @enderror"
                                id="section_text_main_why_choose_us" name="section_text_main_why_choose_us"
                                value="{{ $opt_cms['section_why_choose_us']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Why Choose Us' section.</small>

                            @error('section_text_main_why_choose_us')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_why_choose_us">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_why_choose_us') is-invalid @enderror"
                                id="section_text_secondary_why_choose_us" name="section_text_secondary_why_choose_us"
                                value="{{ $opt_cms['section_why_choose_us']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Why Choose Us'
                                section.</small>

                            @error('section_text_secondary_why_choose_us')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- MEMBER -->
                        <h3>Team Member</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_member">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_member') is-invalid @enderror"
                                id="section_text_main_member" name="section_text_main_member"
                                value="{{ $opt_cms['section_member']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Team Member' section.</small>

                            @error('section_text_main_member')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_member">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_member') is-invalid @enderror"
                                id="section_text_secondary_member" name="section_text_secondary_member"
                                value="{{ $opt_cms['section_member']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Team Member'
                                section.</small>

                            @error('section_text_secondary_member')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Counter -->
                        <h3>Counter Statistic</h3>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Section Image <span class="text-danger">*</span></label>

                            @if ($opt_cms['section_statistic']['image'])
                                <div class="image-preview" id="showImageCounter">
                                    <img src="{{ asset('storage/' . $opt_cms['section_statistic']['image']) }}"
                                        id="imageSectionStatistic" class="img-fluid">
                                    <input type="hidden" name="imageSectionStatisticOld"
                                        value="{{ $opt_cms['section_statistic']['image'] }}">
                                </div>
                            @else
                            <div id="showImageCounter"></div>
                            @endif

                            <input class="form-control" type="file" id="section_image_statistic"
                                name="section_image_statistic" onchange="previewFileAdd(this, 'showImageCounter');"
                                accept="image/png, image/jpg, image/jpeg">

                            <small class="text-muted mt-3">Allowed file types: png, jpg, jpeg.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_main_statistic">Text Main <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_main_statistic') is-invalid @enderror"
                                id="section_text_main_statistic" name="section_text_main_statistic"
                                value="{{ $opt_cms['section_statistic']['text_main'] }}">

                            <small class="text-muted mt-3">Change the main text for the 'Statistic' section.</small>

                            @error('section_text_main_statistic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_secondary_statistic">Text Secondary <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('section_text_secondary_statistic') is-invalid @enderror"
                                id="section_text_secondary_statistic" name="section_text_secondary_statistic"
                                value="{{ $opt_cms['section_statistic']['text_secondary'] }}">

                            <small class="text-muted mt-3">Change the secondary text for the 'Statistic'
                                section.</small>

                            @error('section_text_secondary_statistic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section_text_description_statistic">Text Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('section_text_description_statistic') is-invalid @enderror" rows="2"
                                spellcheck="false" name="section_text_description_statistic" id="section_text_description_statistic">{{ $opt_cms['section_statistic']['text_description'] }}</textarea>

                            <small class="text-muted mt-3">Change the description text for the 'Statistic'
                                section.</small>

                            @error('section_text_description_statistic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="py-2 form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
