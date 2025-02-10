
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Site Settings</h5>
        </div>
        <div class="list-group list-group-flush" role="tablist">
            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings') ? 'active' : '' }}"  href="{{ route('settings.index') }}" role="tab" aria-selected="true">
                General
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/contact') ? 'active' : '' }}"  href="{{ route('settings.contact') }}" role="tab" aria-selected="false">
                Contact Info & SMTP Settings
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/seo') ? 'active' : '' }}"  href="{{ route('settings.seo') }}" role="tab" aria-selected="false">
                SEO Settings
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/tools') ? 'active' : '' }}"  href="{{ route('settings.tools') }}" role="tab" aria-selected="false">
                Menu Settings
            </a>
            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/ads') ? 'active' : '' }}"  href="{{ route('settings.ads') }}" role="tab" aria-selected="false">
                Ad Spots
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/api') ? 'active' : '' }}"  href="{{ route('settings.api') }}" role="tab" aria-selected="false">
                API Settings
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/cms-section') ? 'active' : '' }}"  href="{{ route('settings.cms.index') }}" role="tab" aria-selected="false">
                CMS Section Settings
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/appearance-homepage') ? 'active' : '' }}"  href="{{ route('settings.homepage.index') }}" role="tab" aria-selected="false">
                Appearance Homepage
            </a>

            <a class="list-group-item list-group-item-action {{ Request::is('dashboard/settings/appearance-navbar') ? 'active' : '' }}"  href="{{ route('settings.navbar.index') }}" role="tab" aria-selected="false">
                Appearance Navbar
            </a>
        </div>
    </div>

@push('css')
    <style>
        .list-group-item {
            padding: .75rem 1.25rem
        }
    </style>
@endpush
