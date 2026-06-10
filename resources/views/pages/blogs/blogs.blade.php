@extends('layouts.guest')
@section('body-class', 'loadmore')
@section('content')
<!-- Page-title -->
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title ml-11 split-text effect-right">
        Blog Standard
      </h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">Blog Standard</span>
      </div>
    </div>
  </div>
</div>
<!-- /.page-title -->

<!-- Main-content -->
<div class="main-content">
  <div class="list-post-gird tf-spacing-2">
    <div class="tf-container">
      <div class="row rg-30">

        <!-- Blog Grid -->
        <div class="col-xl-8">
          <button id="filterShop" class="fillter-btn style-fixed d-xl-none">
            <i class="icon-sidebar"></i>
          </button>

          {{-- Desktop / tablet grid (hidden on small mobile) --}}
          <div class="tf-grid-2 loadmore-item d-none d-sm-grid">
            @forelse ($blogs as $blog)
            <div class="fl-item">
              <div class="tf-post-grid hover-image">
                <div class="top">
                  <a href="{{ route('blog-details', $blog->slug) }}" class="image">
                    @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}"
                      alt="{{ $blog->title }}" class="lazyload">
                    @else
                    <img src="image/blog/blog-grid-1.jpg"
                      alt="{{ $blog->title }}" class="lazyload">
                    @endif
                  </a>
                  <div class="post-content px-md-15">
                    @if ($blog->category)
                    <div class="category-post">
                      <a href="#" class="item">{{ $blog->category->name }}</a>
                    </div>
                    @endif
                    <h6 class="title lh-32">
                      <a href="{{ route('blog-details', $blog->slug) }}" class="line-clamp-3">
                        {{ $blog->title }}
                      </a>
                    </h6>
                  </div>
                </div>
                <div class="bottom-item px-md-15">
                  <i class="icon-email"></i>
                  <span>
                    {{ ($blog->published_at ?? $blog->created_at)->format('F d, Y') }}
                  </span>
                </div>
              </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
              <p>No blog posts available yet.</p>
            </div>
            @endforelse
          </div>

          {{-- Mobile swiper (visible only on small screens) --}}
          @if($blogs->isNotEmpty())
          <div class="d-sm-none blog-mobile-swiper">
            <div class="swiper tf-swiper sw-blog-mobile"
              data-swiper='{
                                    "slidesPerView": 1.05,
                                    "spaceBetween": 16,
                                    "speed": 600,
                                    "loop": false,
                                    "navigation": {
                                        "nextEl": ".blog-mobile-next",
                                        "prevEl": ".blog-mobile-prev"
                                    },
                                    "pagination": {
                                        "el": ".blog-mobile-pagination",
                                        "clickable": true
                                    }
                                }'>
              <div class="swiper-wrapper">
                @foreach($blogs as $blog)
                <div class="swiper-slide">
                  <div class="tf-post-grid hover-image">
                    <div class="top">
                      <a href="{{ route('blog-details', $blog->slug) }}" class="image">
                        @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}"
                          alt="{{ $blog->title }}" class="lazyload">
                        @else
                        <img src="image/blog/blog-grid-1.jpg"
                          alt="{{ $blog->title }}" class="lazyload">
                        @endif
                      </a>
                      <div class="post-content px-md-15">
                        @if ($blog->category)
                        <div class="category-post">
                          <a href="#" class="item">{{ $blog->category->name }}</a>
                        </div>
                        @endif
                        <h6 class="title lh-32">
                          <a href="{{ route('blog-details', $blog->slug) }}" class="line-clamp-3">
                            {{ $blog->title }}
                          </a>
                        </h6>
                      </div>
                    </div>
                    <div class="bottom-item px-md-15">
                      <i class="icon-email"></i>
                      <span>
                        {{ ($blog->published_at ?? $blog->created_at)->format('F d, Y') }}
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <div class="blog-mobile-controls">
              <button class="blog-mobile-prev arrow-btn style-border w-50">
                <i class="icon-arrow-left2"></i>
              </button>
              <div class="blog-mobile-pagination sw-pagination"></div>
              <button class="blog-mobile-next arrow-btn style-border w-50">
                <i class="icon-arrow-right2"></i>
              </button>
            </div>
          </div>
          @endif
        </div>
        <!-- /.Blog Grid -->

        <!-- Sidebar -->
        <div class="col-xl-4">
          <div class="tf-sidebar sidebar-filter right">
            <div class="header-fillter flex justify-content-between align-items-center d-xl-none mb-30">
              <h3 class="title">Filter</h3>
              <span class="icon-close close-filter"></span>
            </div>

            <!-- Search -->
            <div class="sidebar-item sidebar-search">
              <h5 class="title-content fw-5">Search</h5>
              <form action="{{ route('blogs') }}" method="GET" class="form-search-siderbar">
                <fieldset>
                  <input type="text" name="q" placeholder="Keywords"
                    value="{{ request('q') }}">
                  <button type="submit" class="tf-btn-search">
                    <i class="icon-magnifying-glass"></i>
                  </button>
                </fieldset>
              </form>
            </div>

            <!-- Categories -->
            @if ($categories->count())
            <div class="sidebar-item sidebar-content sidebar-categories mb-40">
              <h5 class="title-content fw-5">Category</h5>
              <ul class="list">
                @foreach ($categories as $cat)
                <li class="item">
                  <i class="icon-arrow-right"></i>
                  <a href="#" class="body-2 fw-5">
                    {{ $cat->name }}
                    @if ($cat->blogs_count)
                    <span class="text-muted">({{ $cat->blogs_count }})</span>
                    @endif
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
            @endif

            <!-- Latest News -->
            @if ($recentBlogs->count())
            <div class="sidebar-item sidebar-content sidebar-recent-posts">
              <h4 class="title-content fw-5">Latest News</h4>
              @foreach ($recentBlogs as $recent)
              <div class="tf-post-list style-small hover-img">
                <a href="{{ route('blog-details', $recent->slug) }}" class="image">
                  @if ($recent->image)
                  <img src="{{ asset('storage/' . $recent->image) }}"
                    alt="{{ $recent->title }}" class="lazyload">
                  @else
                  <img src="image/blog/post-list-1.jpg"
                    alt="{{ $recent->title }}" class="lazyload">
                  @endif
                </a>
                <div class="post-content">
                  <div class="post-date">
                    <i class="icon-email"></i>
                    <span>{{ ($recent->published_at ?? $recent->created_at)->format('M d, Y') }}</span>
                  </div>
                  <a href="{{ route('blog-details', $recent->slug) }}" class="body-2">
                    {{ Str::limit($recent->title, 35) }}
                  </a>
                </div>
              </div>
              @endforeach
            </div>
            @endif

            <!-- Popular Tags -->
            @php
            $allTags = $blogs->pluck('tags')->filter()->flatMap(fn($t) => array_map('trim', explode(',', $t)))->unique()->values();
            @endphp
            @if ($allTags->count())
            <div class="sidebar-item sidebar-tags mb-50">
              <h4 class="title-content fw-5">Popular Tags</h4>
              <div class="tabs-list">
                @foreach ($allTags->take(10) as $tag)
                <a href="#" class="tabs-item fw-5">{{ $tag }}</a>
                @endforeach
              </div>
            </div>
            @endif

            <div class="sidebar-banner box-item">
              <div class="box-content px-sm-15">
                <p class="sub-title">Get A Quote</p>
                <h4 class="title">Looking For Creative Web Designer</h4>
                <a href="{{ route('contact-us') }}" class="tf-btn">
                  <span>Hire Me</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.Sidebar -->

      </div>
    </div>
  </div>
</div>
<!-- /.main-content -->
@endsection