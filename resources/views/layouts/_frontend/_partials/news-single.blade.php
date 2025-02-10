<div class="post-content post-single">
    <div class="post-media post-image">
        <img loading="lazy" src="{{ asset('storage/' . $news->thumbnail) }}" class="img-fluid rounded" alt="post-image">
    </div>

    <div class="post-body">
        <div class="entry-header">
            <div class="post-meta">
                <span class="post-author">
                    <i class="far fa-user"></i> <span>Admin</span>
                </span>
                <span class="post-cat">
                    <i class="far fa-folder-open"></i> <a
                        href="{{ route('frontend.news.index', ['category' => $news->category->title]) }}">{{ $news->category->title }}</a>
                </span>
                <span class="post-meta-date"><i class="far fa-calendar"> </i>
                    {{ $news->created_at->diffForHumans() }}</span>
            </div>
            <h2 class="entry-title">{{ $news->title }}</h2>
        </div><!-- header end -->

        <div class="entry-content">
            {!! $news->body !!}
        </div>

        <div class="tags-area d-flex align-items-center justify-content-between">
            <div class="post-tags">
                @php
                    $tags = explode(',', $news->tags);
                @endphp
                @foreach ($tags as $tag)
                    <a href="javascript:void(0);">{{ trim($tag) }}</a>
                @endforeach
            </div>

            <div class="share-items">
                <ul class="post-social-icons list-unstyled">
                    <li class="social-icons-head">Share:</li>
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                            target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($news->title) }}"
                            target="_blank"><i class="fab fa-twitter"></i></a></li>

                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::fullUrl()) }}&title={{ urlencode($news->title) }}"
                            target="_blank"><i class="fab fa-linkedin"></i></a></li>

                    <li><a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}"
                            target="_blank"><i class="fab fa-google-plus"></i></a></li>

                </ul>
            </div>
        </div>
    </div><!-- post-body end -->
</div><!-- post-content post-single end -->
