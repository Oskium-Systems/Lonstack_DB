@extends('layouts.guest')

@section('content')

    <!-- Page-title -->
    <div class="page-title">
        <div class="tf-container">
            <div class="page-title-content text-center">
                <h1 class="title ml-11 split-text effect-right">Project Details</h1>
                <div class="breadkcum">
                    <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
                    <span class="dot"></span>
                    <a href="{{ route('portfolio') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Portfolio</a>
                    <span class="dot"></span>
                    <span class="page-breadkcum body-2 fw-7 split-text effect-right">{{ $portfolio->title }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main-content -->
    <div class="main-content tf-spacing-2">
        <div class="tf-container">
            <div class="wg-details wg-project-details tf-spacing-2">

                {{-- Cover image --}}
                <div class="image-blog img-1" style="overflow:hidden; border-radius:8px;">
                    @if ($portfolio->cover_image)
                        <img src="{{ asset('storage/' . $portfolio->cover_image) }}"
                             data-src="{{ asset('storage/' . $portfolio->cover_image) }}"
                             alt="{{ $portfolio->title }}" class="lazyload"
                             style="width:100%; height:680px; object-fit:cover; display:block;">
                    @else
                        <img src="{{ asset('image/section/project-details-1.jpg') }}"
                             data-src="{{ asset('image/section/project-details-1.jpg') }}"
                             alt="{{ $portfolio->title }}" class="lazyload"
                             style="width:100%; height:680px; object-fit:cover; display:block;">
                    @endif
                </div>

                <div class="details-content flex justify-content-between g-30 rg-50">

                    {{-- Left: description --}}
                    <div class="left" style="flex:1; min-width:0; overflow:hidden;">
                        <h3 class="title">{{ $portfolio->title }}</h3>

                        @if ($portfolio->description)
                        <div class="desc">
                            <div class="lh-30" style="overflow-wrap:break-word; word-break:break-word;">
                                {!! $portfolio->description !!}
                            </div>
                        </div>
                        @endif

                        {{-- Tags as benefit-style list --}}
                        @if ($portfolio->tags && count($portfolio->tags))
                        <div class="cols mt-30">
                            <div class="list-benefit">
                                @foreach ($portfolio->tags as $tag)
                                <div class="benefit-item">
                                    <i class="icon-check"></i>
                                    <span class="lh-30 body-2">{{ $tag }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Right: metadata sidebar --}}
                    <div class="right" style="flex-shrink:0; width:280px;">
                        <div class="box-info">
                            @if ($portfolio->service)
                            <div class="info-item">
                                <div class="sub-title fw-5">Service</div>
                                <h5 class="title-info fw-5">{{ $portfolio->service->name }}</h5>
                            </div>
                            @endif

                            @if ($portfolio->client)
                            <div class="info-item">
                                <div class="sub-title fw-5">Client</div>
                                <h5 class="title-info fw-5">{{ $portfolio->client }}</h5>
                            </div>
                            @endif

                            @if ($portfolio->location)
                            <div class="info-item">
                                <div class="sub-title fw-5">Location</div>
                                <h5 class="title-info fw-5">{{ $portfolio->location }}</h5>
                            </div>
                            @endif

                            @if ($portfolio->published_at)
                            <div class="info-item">
                                <div class="sub-title fw-5">Published</div>
                                <h5 class="title-info fw-5">{{ $portfolio->published_at->format('F d, Y') }}</h5>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Gallery images --}}
                @if ($portfolio->gallery && count($portfolio->gallery))
                <div class="mb-50" style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">
                    @foreach ($portfolio->gallery as $image)
                    <div style="overflow:hidden; border-radius:6px;">
                        <img src="{{ asset('storage/' . $image) }}"
                             data-src="{{ asset('storage/' . $image) }}"
                             alt="{{ $portfolio->title }}" class="lazyload"
                             style="width:100%; height:280px; object-fit:cover; display:block;">
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Project summary --}}
                @if ($portfolio->summary)
                <div class="details-content content-2">
                    <h3 class="title mb-25">Project Summary</h3>
                    <div class="desc">
                        <div class="lh-30" style="overflow-wrap:break-word; word-break:break-word;">
                            {!! $portfolio->summary !!}
                        </div>
                    </div>
                </div>
                @endif

                {{-- Tags + share --}}
                <div class="tag-social flex justify-content-between align-items-center flex-wrap g-20">
                    @if ($portfolio->tags && count($portfolio->tags))
                    <div class="left tags flex g-20 align-items-center">
                        <span class="fw-5">Tags</span>
                        <div class="tabs-list">
                            @foreach ($portfolio->tags as $tag)
                            <a href="{{ route('portfolio') }}" class="tabs-item fw-5">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="right social flex g-20 align-items-center">
                        <span class="fw-5">Share</span>
                        <ul class="post-social style-radius-50 g-10">
                            <li><a href="#" class="icon-social"><i class="icon-fb"></i></a></li>
                            <li><a href="#" class="icon-social"><i class="icon-X"></i></a></li>
                            <li><a href="#" class="icon-social"><i class="icon-linkedin"></i></a></li>
                            <li><a href="#" class="icon-social"><i class="icon-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        {{-- Previous / Next navigation --}}
        @if ($prev || $next)
        <div class="next-prev-details tf-spacing-2">
            <div class="tf-container">
                <div class="row rg-50">
                    @if ($prev)
                    <div class="col-sm-6">
                        <div class="prev-details next-prev-item">
                            <a href="{{ route('portfolio-details', $prev->slug) }}" class="link">
                                <i class="icon-arrow-left"></i> Previous
                            </a>
                            <h4 class="title">
                                <a href="{{ route('portfolio-details', $prev->slug) }}">{{ $prev->title }}</a>
                            </h4>
                            @if ($prev->cover_image)
                            <a href="{{ route('portfolio-details', $prev->slug) }}" class="image">
                                <img src="{{ asset('storage/' . $prev->cover_image) }}"
                                     data-src="{{ asset('storage/' . $prev->cover_image) }}"
                                     alt="{{ $prev->title }}" class="lazyload">
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if ($next)
                    <div class="col-sm-6">
                        <div class="next-details next-prev-item">
                            <a href="{{ route('portfolio-details', $next->slug) }}" class="link">
                                Next <i class="icon-arrow-right"></i>
                            </a>
                            <h4 class="title">
                                <a href="{{ route('portfolio-details', $next->slug) }}">{{ $next->title }}</a>
                            </h4>
                            @if ($next->cover_image)
                            <a href="{{ route('portfolio-details', $next->slug) }}" class="image">
                                <img src="{{ asset('storage/' . $next->cover_image) }}"
                                     data-src="{{ asset('storage/' . $next->cover_image) }}"
                                     alt="{{ $next->title }}" class="lazyload">
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
    <!-- /.main-content -->

    {{-- Related projects — same service, excluding current --}}
    @if ($related->isNotEmpty())
    <section class="section-project tf-spacing-2">
        <div class="tf-container">
            <div class="heading-section mb-60 text-center">
                <div class="sub-title body-2 fw-7 mb-17 title-animation">Related Projects</div>
                <h2 class="title fw-6 title-animation">
                    More From
                    <span class="fw-3">{{ $portfolio->service->name ?? 'This Service' }}</span>
                </h2>
            </div>
        </div>

        <div class="tf-container" style="position:relative;">
            {{-- Prev button --}}
            <a class="arrow-btn style-border w-50 arrow-prev related-prev"
               style="position:absolute; left:-25px; top:50%; transform:translateY(-50%); z-index:10; cursor:pointer;">
                <i class="icon-arrow-left2"></i>
            </a>

            <div class="swiper tf-swiper sw-related-project"
                 data-swiper='{
                    "slidesPerView": 1,
                    "spaceBetween": 30,
                    "speed": 800,
                    "navigation": { "clickable": true, "nextEl": ".related-next", "prevEl": ".related-prev" },
                    "breakpoints": {
                        "768": { "slidesPerView": 2, "slidesPerGroup": 1 }
                    }
                 }'>
                <div class="swiper-wrapper">
                    @foreach ($related as $item)
                    <div class="swiper-slide">
                        <div class="project-gird-item project-item">
                            <a href="{{ route('portfolio-details', $item->slug) }}" class="image"
                               style="display:block; overflow:hidden; border-radius:6px;">
                                @if ($item->cover_image)
                                    <img src="{{ asset('storage/' . $item->cover_image) }}"
                                         data-src="{{ asset('storage/' . $item->cover_image) }}"
                                         alt="{{ $item->title }}" class="lazyload"
                                         style="width:100%; height:320px; object-fit:cover; display:block;">
                                @else
                                    <img src="{{ asset('image/project-item/project-item-2.jpg') }}"
                                         data-src="{{ asset('image/project-item/project-item-2.jpg') }}"
                                         alt="{{ $item->title }}" class="lazyload"
                                         style="width:100%; height:320px; object-fit:cover; display:block;">
                                @endif
                            </a>
                            <div class="item-content">
                                <div class="sub-title body-2 fw-7">{{ $item->service->name ?? '' }}</div>
                                <h3 class="title-project">
                                    <a href="{{ route('portfolio-details', $item->slug) }}">{{ $item->title }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Next button --}}
            <a class="arrow-btn style-border w-50 arrow-next related-next"
               style="position:absolute; right:-25px; top:50%; transform:translateY(-50%); z-index:10; cursor:pointer;">
                <i class="icon-arrow-right2"></i>
            </a>
        </div>
    </section>
    @endif

@endsection
