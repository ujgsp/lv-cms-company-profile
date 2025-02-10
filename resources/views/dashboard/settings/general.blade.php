@extends('dashboard.settings.index')

@section('content_settings')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Site Info</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.general.update', ['option' => 'setting_site_info']) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="logo">Logo <span class="text-danger">*</span></label>
                        <label class="form-label">(Best resolution height- 80 px, width- Any px)</label>

                        @if ($opt_site->logo)
                        <div class="image-preview">
                            <img src="{{ asset('storage/' . $opt_site->logo) }}" alt="{{ $opt_site->website_name }}"
                                id="profileImg" class="img-fluid">
                            <input type="hidden" name="oldImageLogo" value="{{ $opt_site->logo }}">
                        </div>
                        @else
                        <div class="image-preview">
                            <img src="{{ asset('static/images/logo.png') }}" alt="{{ $opt_site->website_name }}"
                                id="profileImg" class="img-fluid">
                        </div>
                        @endif

                        <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo"
                            name="logo" onchange="previewFile(this, 'profileImg');"
                            accept="image/png, image/jpg, image/jpeg">

                        @error('logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <small class="text-muted d-block mt-2">The logo for the website.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="logo">Logo Footer<span class="text-danger">*</span></label>
                        <label class="form-label">(Best resolution height- 80 px, width- Any px)</label>

                        @if ($opt_site->logo_footer)
                        <div class="image-preview">
                            <img src="{{ asset('storage/' . $opt_site->logo_footer) }}" alt="{{ $opt_site->website_name }}"
                                id="profileImgFooter" class="img-fluid">
                            <input type="hidden" name="oldImageLogoFooter" value="{{ $opt_site->logo_footer }}">
                        </div>
                        @else
                        <div class="image-preview">
                            <img src="{{ asset('static/images/logo.png') }}" alt="{{ $opt_site->website_name }}"
                                id="profileImgFooter" class="img-fluid">
                        </div>
                        @endif

                        <input class="form-control @error('logo_footer') is-invalid @enderror" type="file" id="logo_footer"
                            name="logo_footer" onchange="previewFile(this, 'profileImgFooter');"
                            accept="image/png, image/jpg, image/jpeg">

                        @error('logo_footer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <small class="text-muted d-block mt-2">The logo for the website.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="favicon">Favicon <span class="text-danger">*</span></label>
                        <label class="form-label">(Best resolution height- 64 px, width- 64 px)</label>

                        @if ($opt_site->favicon)
                        <div class="image-preview">
                            <img src="{{ asset('storage/' . $opt_site->favicon) }}" alt="{{ $opt_site->website_name }}"
                                id="profileImgFavicon" class="img-fluid">
                            <input type="hidden" name="oldImageFavicon" value="{{ $opt_site->favicon }}">
                        </div>
                        @else
                        <div class="image-preview">
                            <img src="{{ asset('static/images/favicon.png') }}" alt="{{ $opt_site->website_name }}"
                                id="profileImgFavicon" class="img-fluid">
                        </div>
                        @endif

                        <input class="form-control @error('favicon') is-invalid @enderror" type="file" id="favicon"
                            name="favicon" onchange="previewFile(this, 'profileImgFavicon');"
                            accept="image/png, image/jpg, image/jpeg">

                        @error('favicon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <small class="text-muted d-block mt-2">The favicon for the website.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="website">Website Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
                            name="website" value="{{ $opt_site->website_name }}">

                        @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <small class="text-muted d-block mt-2">This is the name of the webiste, shown to
                            end-users.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="footer">Footer Attribution <span
                                class="text-danger">*</span></label>
                        <textarea rows="2" class="form-control @error('footer') is-invalid @enderror" id="footer"
                            name="footer">{{ $opt_site->footer }}</textarea>

                        @error('footer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <small class="text-muted d-block mt-2">Change the footer attribution on your website.</small>
                    </div>

                    <hr>
                    <div class="mb-3">
                        <label class="form-label" for="facebook">Facebook URL</label>
                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook"
                            name="facebook" value="{{ $opt_site->facebook }}">

                        @error('facebook')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="twitter">Twitter URL</label>
                        <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter"
                            name="twitter" value="{{ $opt_site->twitter }}">

                        @error('twitter')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="instagram">Instagram URL</label>
                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram"
                            name="instagram" value="{{ $opt_site->instagram }}">

                        @error('instagram')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="linkedin">LinkedIn URL</label>
                        <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin"
                            name="linkedin" value="{{ $opt_site->linkedin }}">

                        @error('linkedin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="py-2 form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
