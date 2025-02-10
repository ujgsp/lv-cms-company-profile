@extends('dashboard.settings.index')

@section('content_settings')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">API Settings</h5>
        </div>
        <div class="card-body">
            <form method="POST" id="options-api" action="{{ route('settings.api.update', ['option' => 'setting_captcha']) }}">
                @csrf
                @method('PUT')
                <div class="py-2 form-group">
                    <div class="d-inline-flex justify-content-between">
                        <label  class="form-label ">
                            Enable Captcha </label>
                    </div>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="opt_captcha_status" class="form-check-input" {{ $opt_api['recaptcha_keys']['status'] == 'enable' ? 'checked=""' : '' }} name="opt_captcha_status"
                            type="checkbox">
                    </div>
                    <small class="text-muted d-block">Set the status of the Captcha</small>
                </div>
                <div class="mt-2 alert alert-info">You can get Recaptcha v2 Checkbox API Keys from the <a target="_blank" href="https://www.google.com/recaptcha/admin/">Google API Console</a>.</div>
                <div class="py-2 form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">
                            Recaptcha Site Key
                        </label>
                    </div>
                    <input value="{{ $opt_api['recaptcha_keys']['site_key'] }}" class="form-control" id="opt_captcha_site_key"
                        type="text" name="opt_captcha_site_key" placeholder="Your Recaptcha Site Key">
                    <small class="text-muted">Your Recaptcha Site Key provided by Google</small>
                </div>

                <div class="py-2 form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">
                            Recaptcha Secret Key
                        </label>
                    </div>
                    <input value="{{ $opt_api['recaptcha_keys']['secret_key'] }}" class="form-control"
                        id="opt_captcha_secret_key" type="text" name="opt_captcha_secret_key"
                        placeholder="Your Recaptcha Secret Key">
                    <small class="text-muted">Your Recaptcha Secret Key provided by Google</small>
                </div>


                <div class="py-2 form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
