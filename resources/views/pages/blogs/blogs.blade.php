@extends('layouts.guest')
@section('content')

{{-- ── Page Title ── --}}
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">Blog</h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">Blog</span>
      </div>
    </div>
  </div>
</div>

<div class="main-content tf-spacing-2">
  <div class="tf-container">
    <div class="row rg-40">

      {{-- ════════════════════════════════════
           MAIN COLUMN
      ════════════════════════════════════ --}}
      <div class="col-xl-8">

        @if ($blogs->isEmpty())
        <div class="bl-empty">
          <p>No blog posts published yet. Check back soon.</p>
        </div>
        @else

        @php $featured = $blogs->first(); $rest = $blogs->skip(1); @endphp

        {{-- ── FEATURED CARD (first post) ── --}}
        <div class="bl-featured-card">
          <a href="{{ route('blog-details', $featured->slug) }}" class="bl-featured-card__image">
            @if ($featured->image)
            <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}" class="lazyload">
            @else
            <img src="image/blog/blog-grid-1.jpg" alt="{{ $featured->title }}" class="lazyload">
            @endif
            <div class="bl-featured-card__overlay"></div>
          </a>
          <div class="bl-featured-card__body">
            @if ($featured->category)
            <a href="#" class="bl-cat-badge">{{ $featured->category->name }}</a>
            @endif
            <h2 class="bl-featured-card__title">
              <a href="{{ route('blog-details', $featured->slug) }}">{{ $featured->title }}</a>
            </h2>
            @if ($featured->excerpt)
            <p class="bl-featured-card__excerpt">{{ Str::limit($featured->excerpt, 130) }}</p>
            @endif
            <div class="bl-meta">
              <span class="bl-meta__item">
                <i class="icon-calendar-days"></i>
                {{ ($featured->published_at ?? $featured->created_at)->format('d M Y') }}
              </span>
              @if ($featured->author)
              <span class="bl-meta__dot"></span>
              <span class="bl-meta__item">
                <i class="icon-user"></i>
                {{ $featured->author->name }}
              </span>
              @endif
              <span class="bl-meta__dot"></span>
              <span class="bl-meta__item">
                <i class="icon-message"></i>
                {{ $featured->comments_count ?? 0 }}
              </span>
            </div>
          </div>
        </div>

        {{-- ── REMAINING POSTS — 2-column grid ── --}}
        @if ($rest->isNotEmpty())
        <div class="bl-grid">
          @foreach ($rest as $blog)
          <div class="bl-card">
            <a href="{{ route('blog-details', $blog->slug) }}" class="bl-card__image">
              @if ($blog->image)
              <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="lazyload">
              @else
              <img src="image/blog/blog-grid-1.jpg" alt="{{ $blog->title }}" class="lazyload">
              @endif
            </a>
            <div class="bl-card__body">
              @if ($blog->category)
              <a href="#" class="bl-cat-badge bl-cat-badge--sm">{{ $blog->category->name }}</a>
              @endif
              <h5 class="bl-card__title">
                <a href="{{ route('blog-details', $blog->slug) }}">{{ Str::limit($blog->title, 65) }}</a>
              </h5>
              @if ($blog->excerpt)
              <p class="bl-card__excerpt">{{ Str::limit($blog->excerpt, 90) }}</p>
              @endif
              <div class="bl-meta bl-meta--sm">
                <span class="bl-meta__item">
                  <i class="icon-calendar-days"></i>
                  {{ ($blog->published_at ?? $blog->created_at)->format('d M Y') }}
                </span>
                <span class="bl-meta__dot"></span>
                <span class="bl-meta__item">
                  <i class="icon-message"></i>
                  {{ $blog->comments_count ?? 0 }}
                </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @endif

        @endif

      </div>
      {{-- /.col-xl-8 --}}

      {{-- ════════════════════════════════════
           SIDEBAR
      ════════════════════════════════════ --}}
      <div class="col-xl-4">
        <div class="tf-sidebar sidebar-filter right">

          {{-- Mobile filter toggle --}}
          <div class="header-fillter flex justify-content-between align-items-center d-xl-none mb-30">
            <h3 class="title">Filter</h3>
            <span class="icon-close close-filter"></span>
          </div>

          {{-- Search --}}
          <div class="sidebar-item sidebar-search">
            <h5 class="title-content fw-5">Search</h5>
            <form action="{{ route('blogs') }}" method="GET" class="form-search-siderbar">
              <fieldset>
                <input type="text" name="q" placeholder="Search articles..."
                  value="{{ request('q') }}">
                <button type="submit" class="tf-btn-search">
                  <i class="icon-magnifying-glass"></i>
                </button>
              </fieldset>
            </form>
          </div>

          {{-- Categories --}}
          @if ($categories->count())
          <div class="sidebar-item sidebar-content sidebar-categories mb-40">
            <h5 class="title-content fw-5">Categories</h5>
            <ul class="list">
              @foreach ($categories as $cat)
              <li class="item">
                <i class="icon-arrow-right"></i>
                <a href="#" class="body-2 fw-5">
                  {{ $cat->name }}
                  @if ($cat->blogs_count)
                  <span style="color:rgba(255,255,255,0.35); font-size:12px; margin-left:4px;">({{ $cat->blogs_count }})</span>
                  @endif
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          @endif

          {{-- Latest Posts --}}
          @if ($recentBlogs->count())
          <div class="sidebar-item sidebar-content sidebar-recent-posts">
            <h4 class="title-content fw-5">Latest Posts</h4>
            @foreach ($recentBlogs as $recent)
            <div class="tf-post-list style-small hover-img">
              <a href="{{ route('blog-details', $recent->slug) }}" class="image">
                @if ($recent->image)
                <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}" class="lazyload">
                @else
                <img src="image/blog/post-list-1.jpg" alt="{{ $recent->title }}" class="lazyload">
                @endif
              </a>
              <div class="post-content">
                <div class="post-date">
                  <i class="icon-calendar-days"></i>
                  <span>{{ ($recent->published_at ?? $recent->created_at)->format('M d, Y') }}</span>
                </div>
                <a href="{{ route('blog-details', $recent->slug) }}" class="body-2">
                  {{ Str::limit($recent->title, 40) }}
                </a>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          {{-- Tags --}}
          @php
          $allTags = $blogs->pluck('tags')->filter()
          ->flatMap(fn($t) => array_map('trim', explode(',', $t)))
          ->unique()->values();
          @endphp
          @if ($allTags->count())
          <div class="sidebar-item sidebar-tags mb-50">
            <h4 class="title-content fw-5">Popular Tags</h4>
            <div class="tabs-list">
              @foreach ($allTags->take(12) as $tag)
              <a href="#" class="tabs-item fw-5">{{ $tag }}</a>
              @endforeach
            </div>
          </div>
          @endif

          {{-- CTA --}}
          <div class="sidebar-banner box-item">
            <div class="box-content px-sm-15">
              <p class="sub-title">Get A Quote</p>
              <h4 class="title">Looking For a Tech Partner?</h4>
              <a href="{{ route('contact-us') }}" class="tf-btn">
                <span>Get In Touch</span>
                <i class="icon-arrow-right"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
      {{-- /.sidebar --}}

    </div>
  </div>
</div>

@endsection