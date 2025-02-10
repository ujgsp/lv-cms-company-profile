
@if ($news->isEmpty())
No posts found..
@else
@foreach ($news as $n)
    <div class="post">
        <div class="post-media post-image">
            <img loading="lazy" src="{{ asset('storage/'. $n->thumbnail) }}" class="img-fluid" alt="post-image">
        </div>

        <div class="post-body">
            <div class="entry-header">
                <div class="post-meta">
                    <span class="post-author">
                        <i class="far fa-user"></i> Admin
                    </span>
                    <span class="post-cat">
                        <i class="far fa-folder-open"></i> <a href="{{ route('frontend.news.index', ['category' => $n->category->title]) }}">{{ $n->category->title }}</a>
                    </span>
                    <span class="post-meta-date">
                        <i class="far fa-calendar"></i> {{ $n->created_at->diffForHumans() }}
                    </span>
                </div>
                <h2 class="entry-title">
                    <a href="{{ route('frontend.news.single', ['news' => $n->slug]) }}">{{ $n->title }}</a>
                </h2>
            </div><!-- header end -->

            <div class="entry-content">
                {{ $n->excerpt }}
            </div>

            <div class="post-footer">
                <a href="{{ route('frontend.news.single', ['news' => $n->slug]) }}" class="btn btn-primary">Continue Reading</a>
            </div>
        </div><!-- post-body end -->
    </div><!-- post end -->
@endforeach

{{ $news->links('vendor.pagination.bootstrap-4') }}
@endif
