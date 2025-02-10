@extends('layouts.dashboard')

@section('title')
Add Service
@endsection

@section('description')
Add a New Service for your Website
@endsection

@section('content')
<div class="mt-3 card">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="title">TLD <span class="text-danger">*</span></label>
                    <input class="form-control " type="text" name="tld" id="tld" value=""
                        placeholder="Enter the Domain Extension Starting with .">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="email">WHOIS Server <span class="text-danger">*</span></label>
                    <input class="form-control " type="text" name="server" id="server" value=""
                        placeholder="The WHOIS server for this TLD">
                    <small class="text-muted">HTTP(s) Whois Server should start with http:// or https://</small>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="pattern">Pattern to Match <span class="text-danger">*</span></label>
                    <textarea rows="3" class="form-control " name="pattern" id="pattern"
                        placeholder="Enter the NOT FOUND pattern for this TLD"></textarea>
                    <small class="mt-2 text-muted d-block">This is the <strong class="text-danger">NOT FOUND</strong>
                        pattern. If this pattern is found in the result, this means that the domain is
                        available.</small>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="affiliate_link">Affiliate Link <span
                            class="text-danger">*</span></label>
                    <input class="form-control " type="text" name="affiliate_link" id="affiliate_link" value=""
                        placeholder="Your Affiliate Link for this Domain.">
                    <small class="mt-2 text-muted d-block">This <strong>x</strong> wildcard should be added where the
                        domain-name is supposed to appear in the link.</small>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="price">Price (USD) <span class="text-danger">*</span></label>
                    <input class="form-control " type="number" step="any" name="price" id="price" value=""
                        placeholder="Price in USD">
                    <small class="mt-2 text-muted d-block">If <strong>ExchangeRateAPI</strong> is enabled, this price
                        will automatically be converted to the user's preference.</small>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="status">Main TLD</label>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="is_main" class="form-check-input" name="is_main" type="checkbox">
                    </div>
                    <small class="text-muted d-block">Whether this is the Main TLD or Not.</small>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="status">Status</label>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="status" class="form-check-input" checked="" name="status" type="checkbox">
                    </div>
                    <small class="text-muted d-block">Whether to Enable or Disable this TLD.</small>
                </div>
            </div>
            <div class="mb-3">
                <input type="hidden" name="submit" value="true">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="https://domainskit.bitflan.com/admin/tlds" class="btn btn-danger btn-lg">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
