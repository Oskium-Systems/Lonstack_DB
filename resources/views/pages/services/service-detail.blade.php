@extends('layouts.guest')

@section('content')

{{-- ══════════════════════════════════════════
     PAGE TITLE / BREADCRUMB
══════════════════════════════════════════ --}}
<div class="page-title">
  <div class="tf-container">
    <div class="page-title-content text-center">
      <h1 class="title split-text effect-right">
        {{ $service->name }}
      </h1>
      <div class="breadkcum">
        <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
        <span class="dot"></span>
        <a href="{{ route('services') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Services</a>
        <span class="dot"></span>
        <span class="page-breadkcum body-2 fw-7 split-text effect-right">{{ $service->name }}</span>
      </div>
    </div>
  </div>
</div>

<div class="main-content position-relative">

  {{-- Background mask --}}
  <div class="mask mask-service-4">
    <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
      <circle cx="400" cy="400" r="325" stroke="url(#sd1)" stroke-width="150" />
      <defs>
        <linearGradient id="sd1" x1="176" x2="569" y1="70.5" y2="674">
          <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
          <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </linearGradient>
      </defs>
    </svg>
  </div>

  {{-- ══════════════════════════════════════════
         HERO SECTION
         Uses the same two-column layout as services.blade.php
         Left = image, Right = headline + description + CTAs
    ══════════════════════════════════════════ --}}
  @if($service->hero)
  <section class="section-about p-services tf-spacing-3">
    <div class="tf-container">
      <div class="row">

        {{-- Left: hero image --}}
        @if($service->hero->image)
        <div class="col-lg-6">
          <div class="left">
            <div class="image tf-animate-2">
              <img src="{{ asset('storage/' . $service->hero->image) }}"
                data-src="{{ asset('storage/' . $service->hero->image) }}"
                alt="{{ $service->hero->headline }}"
                class="lazyload" style="border-radius:16px;">
            </div>
          </div>
        </div>
        @endif

        {{-- Right: headline + description + CTAs --}}
        <div class="{{ $service->hero->image ? 'col-lg-6' : 'col-lg-8 offset-lg-2 text-center' }}">
          <div class="right">
            <div class="heading-section mb-45">
              <div class="sub-title body-2 fw-7 mb-17 title-animation">
                {{ $service->category->name }}
              </div>
              <h2 class="title fw-6 title-animation">
                {{ $service->hero->headline }}
              </h2>
            </div>
            @if($service->hero->description)
            <div class="section-content">
              <div class="desc mb-40 text-animation">
                <div class="lh-30">{!! $service->hero->description !!}</div>
              </div>
            </div>
            @endif
            <div class="flex flex-wrap align-items-center g-15 title-animation">
              @if($service->hero->cta_primary_label)
              <a href="{{ $service->hero->cta_primary_url ?? route('contact-us') }}" class="tf-btn">
                <span>{{ $service->hero->cta_primary_label }}</span>
                <i class="icon-arrow-right"></i>
              </a>
              @endif
              @if($service->hero->cta_secondary_label)
              <a href="{{ $service->hero->cta_secondary_url ?? route('contact-us') }}" class="tf-btn no-bg text-underline">
                <span>{{ $service->hero->cta_secondary_label }}</span>
                <i class="icon-arrow-right"></i>
              </a>
              @endif
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         BENEFITS SECTION
         Numbered list using .benefit-item pattern
    ══════════════════════════════════════════ --}}
  @if($service->benefits->isNotEmpty())
  <section class="section-services tf-spacing-2">
    <div class="tf-container">

      @if($service->benefits->first()->section_heading)
      <div class="heading-section mb-60 text-center">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          {{ $service->benefits->first()->section_heading }}
        </div>
        @if($service->benefits->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {!! nl2br(e($service->benefits->first()->section_subtitle)) !!}
        </h2>
        @endif
      </div>
      @endif

      <div class="row rg-30">
        @foreach($service->benefits as $benefit)
        <div class="col-lg-6">
          <div class="flex g-20" style="padding:24px;border:1px solid var(--stroke-2);border-radius:12px;height:100%;">
            <div class="flex-shrink-0" style="width:48px;height:48px;border-radius:10px;background:rgba(var(--primary-rgb),.12);display:flex;align-items:center;justify-content:center;">
              <span class="fw-7" style="font-size:18px;color:var(--primary);">
                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
              </span>
            </div>
            <div>
              <h5 class="fw-6 mb-10 title-animation">{{ $benefit->title }}</h5>
              @if($benefit->description)
              <div class="desc lh-30 text-animation">{!! $benefit->description !!}</div>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         TALK TO US SECTION
         Person card — uses the CTA banner style
    ══════════════════════════════════════════ --}}
  @if($service->talkToUs)
  @php $talk = $service->talkToUs; @endphp
  <section class="tf-spacing-2">
    <div class="tf-container">
      <div class="wg-cta" style="border-radius:16px;padding:40px 50px;background:rgba(255,255,255,.04);border:1px solid var(--stroke-2);">
        <div class="cta-inner flex align-items-center justify-content-between flex-wrap g-30">
          <div class="flex align-items-center g-20">
            @if($talk->person_avatar)
            <img src="{{ asset('storage/' . $talk->person_avatar) }}"
              alt="{{ $talk->person_name }}"
              style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:3px solid var(--primary);flex-shrink:0;">
            @endif
            <div>
              @if($talk->person_name)
              <div class="fw-7 fs-18 title-animation">{{ $talk->person_name }}</div>
              @endif
              @if($talk->person_role)
              <div class="body-2 text-animation" style="opacity:.6;">{{ $talk->person_role }}</div>
              @endif
            </div>
          </div>
          <div style="flex:1;padding:0 40px;">
            <h4 class="fw-6 mb-10 title-animation">{{ $talk->headline }}</h4>
            @if($talk->subtext)
            <p class="body-2 text-animation" style="opacity:.6;">{{ $talk->subtext }}</p>
            @endif
          </div>
          <a href="{{ $talk->cta_url }}" class="tf-btn flex-shrink-0">
            <span>{{ $talk->cta_label }}</span>
            <i class="icon-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         PROCESS STEPS SECTION
         Uses .wg-according accordion style from faq.blade.php
         but rendered as numbered cards in a grid
    ══════════════════════════════════════════ --}}
  @if($service->processSteps->isNotEmpty())
  <section class="section-company tf-spacing-2">
    <div class="tf-container">

      @if($service->processSteps->first()->section_heading)
      <div class="heading-section mb-60 text-center">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          {{ $service->processSteps->first()->section_heading }}
        </div>
        @if($service->processSteps->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {!! nl2br(e($service->processSteps->first()->section_subtitle)) !!}
        </h2>
        @endif
      </div>
      @endif

      <div class="row rg-30">
        @foreach($service->processSteps as $step)
        <div class="col-lg-4 col-md-6">
          <div style="padding:32px 28px;border:1px solid var(--stroke-2);border-radius:16px;height:100%;position:relative;overflow:hidden;">
            {{-- Large background number --}}
            <div style="position:absolute;top:-10px;right:16px;font-size:80px;font-weight:800;color:rgba(255,255,255,.04);line-height:1;pointer-events:none;user-select:none;">
              {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
            </div>
            <div class="mb-20" style="width:44px;height:44px;border-radius:10px;background:rgba(var(--primary-rgb),.12);display:flex;align-items:center;justify-content:center;">
              <span class="fw-7" style="color:var(--primary);font-size:16px;">
                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
              </span>
            </div>
            <h5 class="fw-6 mb-15 title-animation">{{ $step->title }}</h5>
            @if($step->description)
            <div class="desc lh-30 text-animation">{!! $step->description !!}</div>
            @endif
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         TECH STACK SECTION
         Tag badges grouped by technology group
    ══════════════════════════════════════════ --}}
  @if($service->techGroups->isNotEmpty())
  <section class="tf-spacing-2">
    <div class="tf-container">

      @if($service->techGroups->first()->section_heading)
      <div class="heading-section mb-60 text-center">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          {{ $service->techGroups->first()->section_heading }}
        </div>
        @if($service->techGroups->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {!! nl2br(e($service->techGroups->first()->section_subtitle)) !!}
        </h2>
        @endif
      </div>
      @endif

      <div class="row rg-40">
        @foreach($service->techGroups as $group)
        <div class="col-lg-4 col-md-6">
          <div style="padding:28px;border:1px solid var(--stroke-2);border-radius:12px;height:100%;">
            <h6 class="fw-6 mb-20 title-animation" style="text-transform:uppercase;letter-spacing:.08em;font-size:12px;opacity:.6;">
              {{ $group->group_name }}
            </h6>
            <div class="flex flex-wrap g-10">
              @foreach($group->tags as $tag)
              <span style="display:inline-flex;align-items:center;padding:8px 16px;border-radius:50px;font-size:13px;font-weight:{{ $tag->is_featured ? '600' : '400' }};background:{{ $tag->is_featured ? 'rgba(var(--primary-rgb),.15)' : 'rgba(255,255,255,.06)' }};border:1px solid {{ $tag->is_featured ? 'rgba(var(--primary-rgb),.3)' : 'rgba(255,255,255,.1)' }};color:{{ $tag->is_featured ? 'var(--primary)' : 'rgba(255,255,255,.75)' }};">
                {{ $tag->name }}
              </span>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         TESTIMONIALS SECTION
         Uses exact .testimonial-item style-2 pattern
         from testimonials.blade.php
    ══════════════════════════════════════════ --}}
  @if($service->testimonials->isNotEmpty())
  <section class="section-testimonial tf-spacing-2">
    <div class="mask mask-1">
      <svg xmlns="http://www.w3.org/2000/svg" width="700" height="700" fill="none">
        <circle cx="350" cy="350" r="285" stroke="url(#sd2)" stroke-width="130" />
        <defs>
          <linearGradient id="sd2" x1="154" x2="497.875" y1="61.688" y2="589.75">
            <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
            <stop offset="1" stop-color="#fff" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </div>

    <div class="tf-container">

      @if($service->testimonials->first()->section_heading)
      <div class="heading-section mb-60 text-center">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          {{ $service->testimonials->first()->section_heading }}
        </div>
        @if($service->testimonials->first()->section_subtitle)
        <h2 class="title fw-6 title-animation">
          {!! nl2br(e($service->testimonials->first()->section_subtitle)) !!}
        </h2>
        @endif
      </div>
      @endif

      <div class="row rg-30">
        @foreach($service->testimonials as $testimonial)
        <div class="col-xl-4 col-md-6">
          <div class="testimonial-item style-2" style="display:flex;flex-direction:column;height:100%;">
            <div class="top-item">
              <div class="icon">
                <i class="icon-quote2"></i>
              </div>
              {{-- Initials avatar since no image in service testimonials --}}
              <div class="image-avatar d-flex align-items-center justify-content-center"
                style="background:rgba(var(--primary-rgb),.15);color:var(--primary);font-weight:700;font-size:18px;width:72px;height:72px;border-radius:50%;flex-shrink:0;">
                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
              </div>
            </div>
            {{-- Star rating --}}
            <div class="mb-20" style="display:flex;gap:4px;">
              @for($i = 1; $i <= 5; $i++)
                <span style="font-size:15px;color:{{ $i <= $testimonial->rating ? '#f5a623' : 'rgba(255,255,255,.15)' }};">★</span>
                @endfor
            </div>
            <div class="text lh-30" style="flex:1;">
              "{{ $testimonial->quote }}"
            </div>
            <div style="margin-top:24px;padding-top:20px;border-top:1px solid var(--stroke-2);">
              <span class="name-user body-2 fw-6 d-block">{{ $testimonial->client_name }}</span>
              @if($testimonial->client_role)
              <span class="position text-medium d-block">{{ $testimonial->client_role }}</span>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         FAQs SECTION
         Uses exact .wg-according pattern from faq.blade.php
    ══════════════════════════════════════════ --}}
  @if($service->faqs->isNotEmpty())
  <section class="section-company tf-spacing-2">
    <div class="tf-container w-1810">
      <div class="section-company-inner">
        <div class="left-section">

          @if($service->faqs->first()->section_heading)
          <div class="heading-section mb-53">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">
              {{ $service->faqs->first()->section_heading }}
            </div>
            @if($service->faqs->first()->section_subtitle)
            <h2 class="title fw-6 title-animation">
              {!! nl2br(e($service->faqs->first()->section_subtitle)) !!}
            </h2>
            @endif
          </div>
          @endif

          <div class="wg-according" id="serviceFaqs">
            @foreach($service->faqs as $faq)
            <div class="according-item">
              <h5 class="fw-5">
                <a href="#faq-{{ $faq->id }}"
                  data-bs-toggle="collapse"
                  class="title-according {{ $loop->first ? '' : 'collapsed' }}">
                  {{ $faq->question }}<span></span>
                </a>
              </h5>
              <div id="faq-{{ $faq->id }}"
                class="collapse {{ $loop->first ? 'show' : '' }}"
                data-bs-parent="#serviceFaqs">
                <div class="according-content">
                  <div class="right">
                    <div class="desc lh-30">{!! $faq->answer !!}</div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

        </div>
        {{-- Right side decorative image --}}
        <div class="right-section">
          <div class="image image-section tf-animate-1">
            <img src="{{ asset('image/section/img-section-company.jpg') }}"
              data-src="{{ asset('image/section/img-section-company.jpg') }}"
              alt="" class="lazyload">
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- ══════════════════════════════════════════
         RELATED SERVICES SECTION
         Uses exact .services-item pattern from services.blade.php
    ══════════════════════════════════════════ --}}
  @if($service->relatedServices->isNotEmpty())
  <section class="section-services tf-spacing-2">
    <div class="tf-container">

      @if($service->relatedServices->first()->section_heading)
      <div class="heading-section mb-60 text-center">
        <div class="sub-title body-2 fw-7 mb-17 title-animation">
          {{ $service->relatedServices->first()->section_heading }}
        </div>
      </div>
      @endif

      <div class="list-services flex flex-wrap">
        @foreach($service->relatedServices as $related)
        @php $rel = $related->relatedService; @endphp
        <div class="services-item px-lg-15 no-img">
          <div class="icon">
            <i class="{{ $rel->category->icon ?? 'icon-custom-software' }}"></i>
          </div>
          <h5 class="lh-30 fw-6">
            <a href="{{ route('services.show', $rel->slug) }}" class="title-service">
              {{ $rel->name }}
            </a>
          </h5>
          @if($rel->short_description)
          <div class="desc lh-30">{{ $rel->short_description }}</div>
          @endif
          <div class="bottom-item">
            <a href="{{ route('services.show', $rel->slug) }}" class="tf-btn-readmore">
              <span class="plus">+</span>
              <span class="text">Read More</span>
            </a>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

</div>{{-- end .main-content --}}

@endsection