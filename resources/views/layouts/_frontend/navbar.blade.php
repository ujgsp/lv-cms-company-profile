<style>
    /* Hover effect untuk button */
    .header-get-a-quote .btn:hover {
        background-color: #000000 !important;
        /* Warna background saat hover */
        color: #ffffff !important;
        /* Warna teks saat hover */
        border-color: #000000 !important;
        /* Warna border saat hover (jika ada) */
    }
</style>
<header id="header" class="header-two">
    <div class="site-navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">

                        <div class="logo">
                            <a class="d-block" href="{{ route('frontend.index') }}">
                                <img loading="lazy" src="{{ asset('storage/' . $opt_site->logo) }}" alt="Constra">
                            </a>
                        </div><!-- logo end -->

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div id="navbar-collapse" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav ml-auto align-items-center">
                                @foreach ($navigation as $key => $nav)
                                    @if ($nav['navig_status'] == 'enable')
                                        @switch($key)
                                            @case('navig_home')
                                                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('frontend.index') }}">
                                                        {{ ucfirst($nav['navig_title']) }}
                                                    </a>
                                                </li>
                                            @break

                                            @case('navig_about')
                                                <li class="nav-item {{ Request::is('about*') ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('frontend.about') }}">
                                                        {{ ucfirst($nav['navig_title']) }}
                                                    </a>
                                                </li>
                                            @break

                                            @case('navig_service')
                                                <li class="nav-item dropdown {{ Request::is('services*') ? 'active' : '' }}">
                                                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                        {{ ucfirst($nav['navig_title']) }} <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{ route('frontend.services.index') }}">All Services</a></li>
                                                        @foreach ($services as $service)
                                                        <li class="{{ Request::is('services/'.$service->slug) ? 'active' : '' }}">
                                                                <a href="{{ route('frontend.services.detail', ['service' => $service->slug]) }}">{{ $service->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @break

                                            @case('navig_project')
                                                <li class="nav-item dropdown {{ Request::is('projects*') ? 'active' : '' }}">
                                                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                        {{ ucfirst($nav['navig_title']) }} <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{ route('frontend.projects.index') }}">All Projects</a></li>
                                                        @foreach ($project_categories as $project_category)
                                                            <li class="{{ Request::is('projects/'.$project_category->slug) ? 'active' : '' }}"><a href="{{ route('frontend.projects.category', ['category' => $project_category->slug]) }}">{{ $project_category->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @break

                                            @case('navig_pricing')
                                                <li class="nav-item {{ Request::is('pricing*') ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('frontend.pricing') }}">
                                                        {{ ucfirst($nav['navig_title']) }}
                                                    </a>
                                                </li>
                                            @break

                                            @case('navig_news')
                                                <li class="nav-item {{ Request::is('blog*') ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('frontend.news.index') }}">
                                                        {{ ucfirst($nav['navig_title']) }}
                                                    </a>
                                                </li>
                                            @break

                                            @case('navig_faq')
                                                <li class="nav-item {{ Request::is('faqs*') ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('frontend.faqs.index') }}">
                                                        {{ ucfirst($nav['navig_title']) }}
                                                    </a>
                                                </li>
                                            @break

                                            @case('navig_contact')
                                                <li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('frontend.contact.index') }}">
                                                        {{ ucfirst($nav['navig_title']) }}
                                                    </a>
                                                </li>
                                            @break
                                        @endswitch
                                    @endif
                                @endforeach

                                @if (count($pages))
                                    <li class="nav-item dropdown {{ Request::is('pages*') ? 'active' : '' }}">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                            Pages <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach ($pages as $page)
                                                <li class="{{ Request::is('projects/'.$page->slug) ? 'active' : '' }}"><a href="{{ route('frontend.page', ['page' => $page->slug]) }}">{{ $page->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif

                                @if (count($external_link_headers))
                                    @foreach ($external_link_headers as $external_link_header)
                                        <li class="nav-item {{ Request::is($external_link_header->slug.'*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ $external_link_header->location }}" {{ $external_link_header->new_tab ? 'target="_blank"' : '' }}>
                                                {{ $external_link_header->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                                <li class="header-get-a-quote">
                                    <a class="btn btn-primary" href="{{ route('frontend.getQuote.index') }}" style="background-color: #ffb600">Get Free Quote</a>
                                </li>
                            </ul>


                        </div>
                    </nav>
                </div>
                <!--/ Col end -->
            </div>
            <!--/ Row end -->
        </div>
        <!--/ Container end -->

    </div>
    <!--/ Navigation end -->
</header>
