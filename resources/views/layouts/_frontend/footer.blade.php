<footer id="footer" class="footer bg-overlay">
    <div class="footer-main">
        <div class="container">
            <div class="row justify-content-between">
                <div
                    class="col-lg-{{ $opt_contact->enable_office_hours == 'enable' ? '4' : '6' }} col-md-6 footer-widget footer-about">
                    <h3 class="widget-title">About Us</h3>

                    @if ($opt_site->logo)
                    <img loading="lazy" width="200px" class="footer-logo"
                        src="{{ asset('storage/' . $opt_site->logo_footer) }}" alt="Constra">
                    @else
                    <img loading="lazy" width="200px" class="footer-logo"
                        src="{{ asset('static/images/footer-logo.png') }}" alt="Constra">
                    @endif

                    <p>
                        {{ $opt_about_us['short_description'] }}
                    </p>

                    <div class="footer-social">
                        <ul>
                            <li><a href="{{ $opt_site->facebook }}" aria-label="Facebook"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $opt_site->twitter }}" aria-label="Twitter"><i
                                        class="fab fa-twitter"></i></a>
                            </li>
                            <li><a href="{{ $opt_site->instagram }}" aria-label="Instagram"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $opt_site->linkedin }}" aria-label="LinkedIn"><i
                                        class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div><!-- Footer social end -->
                </div><!-- Col end -->

                @if ($opt_contact->enable_office_hours == 'enable')
                <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
                    <h3 class="widget-title">Working Hours</h3>
                    <div class="working-hours">
                        <p class="mt-2">
                            {{ $opt_contact->office_hours }}
                        </p>
                    </div>
                </div><!-- Col end -->
                @endif

                @if (count($pages_footer) || count($external_link_footers))
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                    <h3 class="widget-title">Useful Links</h3>
                    <ul class="list-arrow">
                        @foreach ($pages_footer as $page)
                        <li>
                            <a href="{{ route('frontend.page', ['page' => $page->slug]) }}">{{ $page->title }}</a>
                        </li>
                        @endforeach

                        @foreach ($external_link_footers as $link)
                        <li>
                            <a href="{{ $link->location }}" {{ $link->new_tab == true ? 'target="_blank"' : '' }}>{{ $link->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div><!-- Col end -->
                @endif

            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer main end -->

    <div class="footer-bottom">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="copyright-line">{{ $opt_site->footer }}</p>
                </div>
            </div>

            <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                <button class="btn btn-primary" title="Back to Top">
                    <i class="fa fa-angle-double-up"></i>
                </button>
            </div>
        </div>
    </div>

</footer><!-- Footer end -->
