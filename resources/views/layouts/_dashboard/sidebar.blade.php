<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">
                <img width="160" src="{{ asset('static-admin/img/avatars/logo-relitdev-inverse.svg') }}" alt="Logo">
            </span>
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-header">
                Administration
            </li>

            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('categories.index') }}">
                    <i class="align-middle" data-feather="bookmark"></i> <span class="align-middle">Categories</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/pages*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pages.index') }}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Pages</span>
                </a>
            </li>


            <li class="sidebar-item {{ Request::is('dashboard/news*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('news.index') }}">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">News</span>
                </a>
            </li>

            {{-- <li class="sidebar-item {{ Request::is('dashboard/newsCategories*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('newsCategories.index') }}">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Categories</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ Request::is('dashboard/projects*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('projects.index') }}">
                    <i class="align-middle" data-feather="link-2"></i> <span class="align-middle">Projects</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/services*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('services.index') }}">
                    <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Services</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/pricings*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pricings.index') }}">
                    <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Pricings</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/faqs*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('faqs.index') }}">
                    <i class="align-middle" data-feather="help-circle"></i> <span class="align-middle">FAQs</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="help-circle"></i> <span class="align-middle">FAQ Categories</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ Request::is('dashboard/members*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('members.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Our Team</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/partners*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('partners.index') }}">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Partners</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/testimonials*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('testimonials.index') }}">
                    <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Testimonials</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/usps*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('usps.index') }}">
                    <i class="align-middle" data-feather="info"></i> <span class="align-middle">Why Choose Us</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/sliders*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('sliders.index') }}">
                    <i class="align-middle" data-feather="image"></i> <span class="align-middle">Sliders</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/counters*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('counters.index') }}">
                    <i class="align-middle" data-feather="crosshair"></i> <span class="align-middle">Counters</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/quotes*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('quotes.index') }}">
                    <i class="align-middle" data-feather="message-circle"></i> <span class="align-middle">Quotes</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/contacts*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('contacts.index') }}">
                    <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Emails</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/subscribers*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('subscribers.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Subscribers</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/about*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('about.index') }}">
                    <i class="align-middle" data-feather="globe"></i> <span class="align-middle">About Us</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/links*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('links.index') }}">
                    <i class="align-middle" data-feather="external-link"></i> <span class="align-middle">Header / Footer Links</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/settings*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('settings.index') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('dashboard/destroy-cache') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('cache.destroy') }}">
                    <i class="align-middle" data-feather="trash"></i> <span class="align-middle">Destroy Cache</span>
                </a>
            </li>



        </ul>

        <div class="sidebar-brand">
            <div class="product-info d-flex justify-space-between">
                <span class="badge">{{ env('APP_NAME') }}</span>
                <span class="badge text-success">1.1.1</span>
            </div>
        </div>

    </div>
</nav>
