<div class="sidebar sidebar-right">
    <div class="widget recent-posts">
        <h3 class="widget-title">Recent Posts</h3>
        <ul class="list-unstyled">
            @foreach ($recentPosts as $recent)
                <li class="d-flex align-items-center">
                    <div class="posts-thumb">
                        <a href="#"><img loading="lazy"
                                 alt="img"
                                 src="{{ asset('storage/' . $recent->thumbnail) }}"></a>
                    </div>
                    <div class="post-info">
                        <h4 class="entry-title">
                            <a
                               href="{{ route('frontend.news.single', ['news' => $recent->slug]) }}">{{ $recent->title }}</a>
                        </h4>
                    </div>
                </li>
            @endforeach
        </ul>
    </div><!-- Recent post end -->

    <div class="widget">
        <h3 class="widget-title">Categories</h3>
        <ul class="arrow nav nav-tabs">
            @foreach ($categories as $category)
                <li><a
                       href="{{ route('frontend.news.index', ['category' => $category->title]) }}">{{ $category->title }}</a>
                </li>
            @endforeach
        </ul>
    </div><!-- Categories end -->

    @if (isset($opt_ads['ad_middle']) && $opt_ads['ad_middle']['ad_status'] == 'enable')
        {{-- Iklan di tengah halaman --}}
        <div class="widget mt-3">
            {{-- Menambahkan kelas img-fluid pada elemen <img> --}}
            {!! str_replace('<img', '<img class="img-fluid"', $opt_ads['ad_middle']['ad_code']) !!}
        </div>
    @endif

</div><!-- Sidebar end -->
