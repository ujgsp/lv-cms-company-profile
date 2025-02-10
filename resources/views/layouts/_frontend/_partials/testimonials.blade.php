<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="column-title">Testimonials</h3>

                <div id="testimonial-slide" class="testimonial-slide">

                    @foreach ($testimonials as $testimonial)
                        <div class="item">
                            <div class="quote-item">
                                <span class="quote-text">
                                    {{ $testimonial->description }}
                                </span>

                                <div class="quote-item-footer">
                                    @if ($testimonial->image)
                                    <img loading="lazy" class="testimonial-thumb"
                                    src="{{ asset('storage/'. $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                    @else
                                    <img loading="lazy" class="testimonial-thumb"
                                        src="{{ asset('static/images/team/default_user_2_optimize.png') }}" alt="testimonial">
                                    @endif
                                    <div class="quote-item-info">
                                        <h3 class="quote-author">{{ $testimonial->name }}</h3>
                                        <span class="quote-subtext">{{ $testimonial->designation }}
                                            {{ $testimonial->organization ? '- ' . $testimonial->organization : '' }}
                                        </span>
                                    </div>
                                </div>
                            </div><!-- Quote item end -->
                        </div>
                    @endforeach

                </div>
                <!--/ Testimonial carousel end-->
            </div><!-- Col end -->

            <div class="col-lg-6 mt-5 mt-lg-0">

                <h3 class="column-title">Happy Clients</h3>

                <div class="row all-clients">

                    @foreach ($partners as $partner)
                        <div class="col-sm-4 col-6">
                            <figure class="clients-logo">
                                <a target="_blank" href="{{ $partner->website }}">
                                    @if ($partner->image)
                                        <img loading="lazy" class="img-fluid"
                                            src="{{ asset('storage/' . $partner->image) }}"
                                            alt="{{ $partner->title }}" />
                                    @else
                                        <img loading="lazy" class="img-fluid"
                                            src="{{ asset('static/images/clients/client1.png') }}"
                                            alt="clients-logo" />
                                    @endif
                                </a>
                            </figure>
                        </div><!-- Client 1 end -->
                    @endforeach
                </div><!-- Clients row end -->

            </div><!-- Col end -->

        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Content end -->
@push('css')
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('static/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('static/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('static/plugins/colorbox/colorbox.css') }}">
@endpush

@push('js')
    <!-- Slick Carousel -->
    <script src="{{ asset('static/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('static/plugins/slick/slick-animation.min.js') }}"></script>
    <!-- Color box -->
    <script src="{{ asset('static/plugins/colorbox/jquery.colorbox.js') }}"></script>
    <!-- shuffle -->
    {{-- <script src="{{ asset('static/plugins/shuffle/shuffle.min.js') }}" defer></script> --}}
@endpush
