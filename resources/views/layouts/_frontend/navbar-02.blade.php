<header id="header" class="header-one" style="margin-bottom: 0px;">
    <div class="bg-white">
        <div class="container">
            <div class="logo-area">
                <div class="row align-items-center">
                    <div class="logo-2 col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                        <a class="d-block" href="{{ route('frontend.index') }}">
                            <img loading="lazy" src="{{ asset('storage/' .$opt_site->logo) }}" alt="Constra">
                        </a>
                    </div><!-- logo end -->

                    <div class="col-lg-9 header-right">
                        <ul class="top-info-box">
                            <li>
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-title">Call Us</p>
                                        <p class="info-box-subtitle">{{ $opt_contact->phone }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-title">Email Us</p>
                                        <p class="info-box-subtitle">{{ $opt_contact->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="header-get-a-quote">
                                <a class="btn btn-primary" href="{{ route('frontend.getQuote.index') }}">Get A Quote</a>
                            </li>
                        </ul><!-- Ul end -->
                    </div><!-- header right end -->
                </div><!-- logo area end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </div>

    <div class="site-navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-dark p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div id="navbar-collapse" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav mr-auto">
                                @foreach ($navigation as $key => $nav)
                                    @if ($nav['navig_status'] == 'enable')
                                        @switch($key)
                                            @case('navig_home')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ route('frontend.index') }}">{{ ucfirst($nav['navig_title']) }}</a>
                                                </li>
                                            @break

                                            @case('navig_about')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ route('frontend.about') }}">{{ ucfirst($nav['navig_title']) }}</a>
                                                </li>
                                            @break

                                            @case('navig_service')
                                                <li class="nav-item dropdown">
                                                    <a href="javascript:void(0)" class="nav-link dropdown-toggle"
                                                        data-toggle="dropdown">{{ ucfirst($nav['navig_title']) }} <i
                                                            class="fa fa-angle-down"></i></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{ route('frontend.services.index') }}">All Services</a>
                                                        </li>
                                                        @foreach ($services as $service)
                                                            <li><a
                                                                    href="{{ route('frontend.services.detail', ['service' => $service->slug]) }}">{{ $service->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @break

                                            @case('navig_project')
                                                <li class="nav-item dropdown">
                                                    <a href="javascript:void(0)" class="nav-link dropdown-toggle"
                                                        data-toggle="dropdown">{{ ucfirst($nav['navig_title']) }} <i
                                                            class="fa fa-angle-down"></i></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{ route('frontend.projects.index') }}">All Projects</a>
                                                        </li>
                                                        @foreach ($project_categories as $project_category)
                                                            <li><a
                                                                    href="{{ route('frontend.projects.category', ['category' => $project_category->slug]) }}">{{ $project_category->title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @break

                                            @case('navig_pricing')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ route('frontend.pricing') }}">{{ ucfirst($nav['navig_title']) }}</a>
                                                </li>
                                            @break

                                            @case('navig_news')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ route('frontend.news.index') }}">{{ ucfirst($nav['navig_title']) }}</a>
                                                </li>
                                            @break

                                            @case('navig_faq')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ route('frontend.faqs.index') }}">{{ ucfirst($nav['navig_title']) }}</a>
                                                </li>
                                            @break

                                            @case('navig_contact')
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ route('frontend.contact.index') }}">{{ ucfirst($nav['navig_title']) }}</a>
                                                </li>
                                            @break
                                        @endswitch
                                    @endif
                                @endforeach

                                @if (count($pages))
                                    {{-- PAGES --}}
                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle"
                                            data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach ($pages as $page)
                                                <li><a
                                                        href="{{ route('frontend.page', ['page' => $page->slug]) }}">{{ $page->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif

                                @if (count($external_link_headers))
                                    {{-- EXTERNAL LINK HEADER --}}
                                    @foreach ($external_link_headers as $external_link_header)
                                        <li class="nav-item"><a class="nav-link"
                                                href="{{ $external_link_header->location }}"
                                                {{ $external_link_header->new_tab == true ? 'target="_blank"' : '' }}>{{ $external_link_header->title }}</a>
                                        </li>
                                    @endforeach
                                @endif
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
