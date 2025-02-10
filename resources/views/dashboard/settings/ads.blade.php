@extends('dashboard.settings.index')

@section('content_settings')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Ad Spots</h5>
        </div>
        <div class="card-body">
            <form method="POST" id="options-ads" action="{{ route('settings.ads.update', ['option' => 'setting_ad_spot']) }}">
                @csrf
                @method('PUT')
                <div class="alert alert-info">Ad-blocker Software may prevent you from using this page properly or viewing
                    the ads on your website. Make sure to disable ad-blockers when working with this page.</div>
                <div class="row">
                    <div class="col-6">

                        <div class="py-2 form-group">
                            <div class="d-inline-flex justify-content-between">
                                <label class="form-label ">
                                    Enable Middle Ad Spot
                                </label>
                            </div>
                            <div class="form-check form-switch form-switch-md float-end">
                                <input id="ad_middle_status" class="form-check-input"
                                    {{ $opt_ads['ad_middle']['ad_status'] == 'enable' ? 'checked=""' : '' }}
                                    name="ad_middle_status" type="checkbox">
                            </div>
                            <small class="text-muted d-block">Enable / Disable the Middle Advertisement Spot</small>
                        </div>

                        <div class="py-2 form-group">
                            <div class="d-flex justify-content-between">
                                <label class="form-label">
                                    Middle Ad Code
                                </label>
                            </div>
                            <textarea rows="4" class="form-control" id="ad_middle_code" name="ad_middle_code"
                                placeholder="Ad Code Here">{!! $opt_ads['ad_middle']['ad_code'] !!}</textarea>
                            <small class="text-muted">The Ad Code to insert in the Middle Ad Spot.</small>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="py-2 form-group">
                            <div class="d-inline-flex justify-content-between">
                                <label class="form-label ">
                                    Enable Footer Ad Spot
                                </label>
                            </div>
                            <div class="form-check form-switch form-switch-md float-end">
                                <input id="ad_footer_status" class="form-check-input"
                                    {{ $opt_ads['ad_footer']['ad_status'] == 'enable' ? 'checked=""' : '' }}
                                    name="ad_footer_status" type="checkbox">
                            </div>
                            <small class="text-muted d-block">Enable / Disable the Footer Advertisement Spot</small>
                        </div>
                        <div class="py-2 form-group">
                            <div class="d-flex justify-content-between">
                                <label class="form-label">
                                    Footer Ad Code </label>
                            </div>
                            <textarea rows="4" class="form-control" id="ad_footer_code" name="ad_footer_code"
                                placeholder="Ad Code Here">{!! $opt_ads['ad_footer']['ad_code'] !!}</textarea>
                            <small class="text-muted">The Ad Code to insert in the Footer Ad Spot.</small>
                        </div>
                    </div>
                </div>
                <div class="py-2 form-group">
                    <div class="d-inline-flex justify-content-between">
                        <label class="form-label ">
                            Enable Pop Ad </label>
                    </div>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="ad_pop_status" class="form-check-input"
                            {{ $opt_ads['ad_pop']['ad_status'] == 'enable' ? 'checked=""' : '' }} name="ad_pop_status"
                            type="checkbox">
                    </div>
                    <small class="text-muted d-block">Enable / Disable the Pop Ad</small>
                </div>
                <div class="py-2 form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">
                            Pop Ad Code </label>
                    </div>
                    <textarea rows="4" class="form-control" id="ad_pop_code" name="ad_pop_code" placeholder="Ad Code Here">{!! $opt_ads['ad_pop']['ad_code'] !!}</textarea>
                    <small class="text-muted">The Ad Code to insert as a Pop Ad.</small>
                </div>
                <div class="py-2 form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
