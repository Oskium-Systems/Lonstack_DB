@extends('layouts.guest')

@section('content')

{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
@if($technology->hero)
<section class="tech-hero">
  <div class="tech-hero__orb tech-hero__orb--1"></div>
  <div class="tech-hero__orb tech-hero__orb--2"></div>
  <div class="tech-hero__orb tech-hero__orb--3"></div>
  <div class="tech-hero__grid"></div>

  <div class="tf-container tech-hero__container">
    <div class="row align-items-center">

      {{-- LEFT --}}
      <div class="col-12 col-lg-6">
        <div class="tech-hero__breadcrumb">
          <a href="{{ route('home') }}">Home</a>
          <span class="dot"></span>
          <span>Technologies</span>
          <span class="dot"></span>
          <span class="tech-hero__breadcrumb--current">{{ $technology->name }}</span>
        </div>

        <div class="tech-hero__badge">
          @if($technology->icon)<i class="{{ $technology->icon }}"></i>@endif
          {{ $technology->name }}
        </div>

        <h1 class="tech-hero__headline">
          {!! str_replace(
          $technology->name,
          '<span class="tech-hero__highlight">'.$technology->name.'</span>',
          $technology->hero->headline
          ) !!}
        </h1>

        @if($technology->hero->description)
        <div class="tech-hero__desc">{!! $technology->hero->description !!}</div>
        @endif

        @if($technology->hero->cta_label)
        <a href="{{ $technology->hero->cta_url ?? route('contact-us') }}" class="tf-btn">
          <span>{{ $technology->hero->cta_label }}</span>
          <i class="icon-arrow-right"></i>
        </a>
        @endif
      </div>

      {{-- RIGHT --}}
      <div class="col-lg-6 d-none d-lg-block">
        <div class="tech-hero__visual">
          <div class="tech-hero__center-circle">
            <div class="tech-hero__center-name">
              {{ $technology->name }}
            </div>
          </div>
          @foreach($navTechnologies->where('slug','!=',$technology->slug)->take(6) as $other)
          {{-- Clickable orbit bubble — links to that technology's page --}}
          <a href="{{ route('tech.show', $other->slug) }}" class="tech-hero__orbit-item">
            {{ $other->name }}
          </a>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     MAIN CONTENT
══════════════════════════════════════════ --}}
<div class="main-content">

  {{-- ── ADVANTAGES ── --}}
  @if($technology->advantages->isNotEmpty())
  <section class="td-section">
    <div class="tf-container">

      {{-- Header row --}}
      <div class="td-section-head">
        <div>
          <div class="td-label">{{ $technology->advantages->first()->section_heading ?? 'Advantages' }}</div>
          <h2 class="td-heading">What Are the Advantages of <br> {{ $technology->name }}</h2>
        </div>
        <a href="{{ route('contact-us') }}" class="tf-btn td-section-head__btn">
          <span>Hire Us</span><i class="icon-arrow-right"></i>
        </a>
      </div>

      {{-- Cards grid --}}
      <div class="td-adv-grid">
        @foreach($technology->advantages as $item)
        <div class="td-adv-card">
          <div class="td-adv-card__num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</div>
          <h3 class="td-adv-card__title">{{ $item->title }}</h3>
          @if($item->description)
          <div class="td-adv-card__desc">{!! $item->description !!}</div>
          @endif
        </div>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- ── BENEFITS ── --}}
  @if($technology->benefits->isNotEmpty())
  <section class="td-section td-section--alt">
    <div class="tf-container">
      <div class="td-label">{{ $technology->benefits->first()->section_heading ?? 'Benefits' }}</div>
      <h2 class="td-heading">What Are the Benefits of {{ $technology->name }}</h2>
      <div class="td-ben-grid">
        @foreach($technology->benefits as $item)
        <div class="td-ben-card">
          <div class="td-ben-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</div>
          <div class="td-ben-title">{{ $item->title }}</div>
          @if($item->description)
          <div class="td-ben-desc">{!! $item->description !!}</div>
          @endif
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- ── WHY CHOOSE US ── --}}
  @if($technology->whyUs->isNotEmpty())
  <section class="td-section">
    <div class="tf-container">
      <div class="row">
        <div class="col-lg-4">
          <div class="td-why-sticky">
            <div class="td-label">{{ $technology->whyUs->first()->section_heading ?? 'Why Choose Us' }}</div>
            <h2 class="td-heading">Why Choose Us</h2>
            <a href="{{ route('contact-us') }}" class="tf-btn" style="margin-top:32px;">
              <span>Hire Us</span><i class="icon-arrow-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-7 offset-lg-1">
          @foreach($technology->whyUs as $item)
          <div class="td-why-item">
            <div class="td-why-title">{{ $item->title }}</div>
            @if($item->description)
            <div class="td-why-desc">{!! $item->description !!}</div>
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- ── PROCESS ── --}}
  @if($technology->processes->isNotEmpty())
  <section class="td-section td-section--alt">
    <div class="tf-container">
      <div class="td-label">{{ $technology->processes->first()->section_heading ?? 'Our Process' }}</div>
      <h2 class="td-heading">Our {{ $technology->name }} Process</h2>
      <div class="td-proc-grid">
        @foreach($technology->processes as $item)
        <div class="td-proc-card">
          <div class="td-proc-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</div>
          <div class="td-proc-title">{{ $item->title }}</div>
          @if($item->description)
          <div class="td-proc-desc">{!! $item->description !!}</div>
          @endif
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- ── CONTACT FORM ── --}}
  <section class="td-contact">
    <div class="tf-container">
      <div class="td-contact__inner">
        <div class="td-contact__left">
          <div class="td-label">Get In Touch</div>
          <h2 class="td-heading td-heading--contact">Let's Talk For<br><span class="td-heading--light">Your Next Project</span></h2>
        </div>
        <div class="td-contact__right">
          <form class="form-contact-us style-bg-dark-2 px-md-15" method="post" action="#">
            <div class="cols mb-37 g-30">
              <fieldset class="item">
                <label class="sub-title body-2 fw-5">Full Name</label>
                <fieldset class="position-relative">
                  <i class="icon-user"></i>
                  <input type="text" name="name" placeholder="Your name" required>
                </fieldset>
              </fieldset>
              <fieldset class="item">
                <label class="sub-title body-2 fw-5">Email Address</label>
                <fieldset class="position-relative">
                  <i class="icon-email"></i>
                  <input type="email" name="email" placeholder="your@email.com" required>
                </fieldset>
              </fieldset>
            </div>
            <fieldset class="mb-40">
              <label class="sub-title body-2 fw-5">Message</label>
              <textarea name="message" placeholder="Tell us about your project" required></textarea>
            </fieldset>
            <a href="{{ route('contact-us') }}" class="tf-btn">
              <span>Get A Free Consultation</span><i class="icon-arrow-right"></i>
            </a>
          </form>
        </div>
      </div>
    </div>
  </section>

  {{-- ── FAQs — centered, no col split ── --}}
  @if($technology->faqs->isNotEmpty())
  <section class="td-section td-section--alt">
    <div class="tf-container">
      <div class="td-faq-wrap">
        <div class="td-label">{{ $technology->faqs->first()->section_heading ?? 'FAQ' }}</div>
        <h2 class="td-heading">Frequently Asked Questions</h2>
        <div id="tdFaqs" class="td-faq-list">
          @foreach($technology->faqs as $faq)
          <div class="td-faq-item">
            <a href="#tdfaq-{{ $faq->id }}"
              data-bs-toggle="collapse"
              class="td-faq-toggle {{ $loop->first ? '' : 'collapsed' }}">
              <span>{{ $faq->question }}</span>
              <span class="td-faq-arrow">+</span>
            </a>
            <div id="tdfaq-{{ $faq->id }}"
              class="collapse {{ $loop->first ? 'show' : '' }}"
              data-bs-parent="#tdFaqs">
              <div class="td-faq-body">{!! $faq->answer !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- ── TECH STACK ── --}}
  @if($techStackGroups->isNotEmpty())
  <section class="td-section">
    <div class="tf-container">
      <div class="td-label">Stack</div>
      <h2 class="td-heading">Technologies We Use</h2>
      @foreach($techStackGroups as $group)
      <div class="td-stack-group">
        <div class="td-stack-group-label">{{ $group->name }}</div>
        <div class="td-stack-items">
          @foreach($group->activeItems as $item)
          <div class="td-stack-item">
            @if($item->icon)
            <img src="{{ asset('storage/'.$item->icon) }}" alt="{{ $item->name }}">
            @else
            <div class="td-stack-fallback">{{ strtoupper(substr($item->name,0,2)) }}</div>
            @endif
            <span class="td-stack-item-name">{{ $item->name }}</span>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </section>
  @endif

</div>

@endsection
