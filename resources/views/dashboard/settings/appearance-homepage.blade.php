@extends('dashboard.settings.index')

@section('content_settings')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Appearance Homepage</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.homepage.update', ['option' => 'setting_homepage']) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="homepage_default">Enable Default Homepage</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input id="homepage_default" class="form-check-input" value="default"
                                name="homepage" type="radio" {{ $opt_appearance_homepage['homepage'] == 'default' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="homepage_02">Enable Homepage 02</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input id="homepage_02" class="form-check-input" value="02"
                                name="homepage" type="radio" {{ $opt_appearance_homepage['homepage'] == '02' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="image-preview-homepage">
                            <img src="{{ asset('static/images/homepage/default-homepage.jpg') }}" alt="" id="profileImg"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="image-preview-homepage">
                            <img src="{{ asset('static/images/homepage/02-homepage.jpg') }}" alt="" id="profileImg"
                                class="img-fluid">
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
