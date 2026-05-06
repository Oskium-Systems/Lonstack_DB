@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Blog Details</h4>
                <h6>Viewing blog post</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.blog.all') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i>Back to Blogs
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    {{-- Featured Image --}}
                    <div class="mb-4">
                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('dashboard_assets/img/bg/hero.jpg') }}"
                             class="rounded w-100" alt="{{ $blog->title }}"
                             style="max-height: 400px; object-fit: cover;">
                    </div>

                    {{-- Title + Meta --}}
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="row align-items-start">
                            <div class="col-lg-8">
                                <h4 class="mb-2">{{ $blog->title }}</h4>
                                <div class="d-flex align-items-center flex-wrap gap-3 text-muted fs-13">
                                    <span><i class="ti ti-calendar me-1"></i>
                                        {{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}
                                    </span>
                                    @if ($blog->author)
                                    <span class="d-flex align-items-center gap-1">
                                        <i class="ti ti-user me-1"></i>{{ $blog->author->name }}
                                    </span>
                                    @endif
                                    @if ($blog->category)
                                    <span class="badge bg-soft-info shadow-none fs-11">{{ $blog->category->name }}</span>
                                    @endif
                                    @if ($blog->status)
                                        <span class="badge badge-success"><i class="ti ti-point-filled"></i> Active</span>
                                    @else
                                        <span class="badge badge-danger"><i class="ti ti-point-filled"></i> Inactive</span>
                                    @endif
                                    @if ($blog->featured)
                                        <span class="badge bg-soft-warning shadow-none"><i class="ti ti-star me-1"></i>Featured</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="d-flex align-items-center justify-content-lg-end gap-4 text-center">
                                    <div>
                                        <h6 class="mb-0">{{ $blog->views ?? 0 }}</h6>
                                        <span class="fs-12 text-muted">Views</span>
                                    </div>
                                    <div class="border-start ps-4">
                                        <h6 class="mb-0">{{ $blog->comments->count() }}</h6>
                                        <span class="fs-12 text-muted">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Excerpt --}}
                    @if ($blog->excerpt)
                    <div class="mb-4 pb-4 border-bottom">
                        <h6 class="fw-semibold mb-2">Excerpt</h6>
                        <p class="text-muted mb-0">{{ $blog->excerpt }}</p>
                    </div>
                    @endif

                    {{-- Description --}}
                    <div class="mb-4 pb-4 border-bottom">
                        <h6 class="fw-semibold mb-3">Content</h6>
                        <div class="blog-content lh-lg">
                            {!! $blog->description !!}
                        </div>
                    </div>

                    {{-- Tags --}}
                    @if ($blog->tags)
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <h6 class="me-1 mb-0">Tags:</h6>
                            @foreach (explode(',', $blog->tags) as $tag)
                                <span class="badge bg-soft-info">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- SEO Meta --}}
                    @if ($blog->meta_title || $blog->meta_description)
                    <div class="mb-4 pb-4 border-bottom">
                        <h6 class="fw-semibold mb-3">SEO</h6>
                        @if ($blog->meta_title)
                        <p class="mb-1"><span class="fw-medium">Meta Title:</span> {{ $blog->meta_title }}</p>
                        @endif
                        @if ($blog->meta_description)
                        <p class="mb-0"><span class="fw-medium">Meta Description:</span> {{ $blog->meta_description }}</p>
                        @endif
                    </div>
                    @endif

                    {{-- Comments --}}
                    @if ($blog->comments->count())
                    <div>
                        <h6 class="fw-semibold mb-3">Comments ({{ $blog->comments->count() }})</h6>
                        @foreach ($blog->comments as $comment)
                        <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                            <div>
                                <p class="fw-medium mb-0">{{ $comment->name ?? 'Anonymous' }}</p>
                                <p class="text-muted fs-12 mb-1">{{ $comment->created_at->format('d M Y, h:i A') }}</p>
                                <p class="mb-0">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
