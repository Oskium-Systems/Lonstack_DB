@extends('layouts.guest')

{{-- Hero + section styles live in public/css/custom.css — no @push needed --}}

@section('content')

{{-- ══ HERO ══ --}}
@if($technology->hero)
<section class="tech-hero">
  <div class="tech-hero__orb tech-hero__orb--1"></div>
  <div class="tech-hero__orb tech-hero__orb--2"></div>
  <div class="tech-hero__orb tech-hero__orb--3"></div>
  <div class="tech-hero__grid"></div>
  <div class="tf-container" style="position:relative;z-index:2;width:100%;">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="tech-hero__breadcrumb">
          <a href="{{ route('home') }}">Home</a><span class="dot"></span>
          <span>Technologies</span><span class="dot"></span>
          <span style="color:rgba(255,255,255,.7);">{{ $technology->name }}</span>
        </div>
        <div class="tech-hero__badge">
          @if($technology->icon)<i class="{{ $technology->icon }}"></i>@endif
          {{ $technology->name }} Development
        </div>
        <h1 class="tech-hero__headline">
          {!! str_replace($technology->name, '<span class="highlight">'.$technology->name.'</span>', $technology->hero->headline) !!}
        </h1>
        @if($technology->hero->description)
        <div class="tech-hero__desc">{!! $technology->hero->description !!}</div>
        @endif
        @if($technology->hero->cta_label)
        <a href="{{ $technology->hero->cta_url ?? route('contact-us') }}" class="tech-hero__cta">
          <span>{{ $technology->hero->cta_label }}</span>
          <i class="icon-arrow-right"></i>
        </a>
        @endif
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <div class="tech-hero__visual">
          <div class="tech-hero__center-circle">
            <div class="name">{{ $technology->name }}<br>Development<br>Company</div>
          </div>
          @foreach($navTechnologies->where('slug','!=',$technology->slug)->take(6) as $other)
          <div class="tech-hero__orbit-item">{{ $other->name }}<br>Development<br>Company</div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<div class="main-content position-relative">

  {{-- ADVANTAGES --}}
  @if($technology->advantages->isNotEmpty())
  <section class="td-section">
    <div class="tf-container">
      <div class="row align-items-end">
        <div class="col-lg-5">
          <div class="td-label">{{ $technology->advantages->first()->section_heading ?? 'Advantages' }}</div>
          <h2 class="td-heading">Why {{ $technology->name }}<span class="td-dim"> is the right choice</span></h2>
        </div>
        <div class="col-lg-3 offset-lg-4 text-lg-end mt-4 mt-lg-0">
          <a href="{{ route('contact-us') }}" class="tf-btn"><span>Hire Us</span><i class="icon-arrow-right"></i></a>
        </div>
      </div>
      <div class="td-adv-list">
        @foreach($technology->advantages as $item)
        <div class="td-adv-item">
          <div class="td-adv-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</div>
          <div class="td-adv-title title-animation">{{ $item->title }}</div>
          @if($item->description)<div class="td-adv-desc text-animation">{!! $item->description !!}</div>@endif
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- BENEFITS --}}
  @if($technology->benefits->isNotEmpty())
  <section class="td-section td-section--alt">
    <div class="tf-container">
      <div class="td-label">{{ $technology->benefits->first()->section_heading ?? 'Benefits' }}</div>
      <h2 class="td-heading mb-0">What you get<span class="td-dim"> with {{ $technology->name }}</span></h2>
      <div class="td-ben-grid">
        @foreach($technology->benefits as $item)
        <div class="td-ben-card">
          <span class="td-ben-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span>
          <div class="td-ben-title title-animation">{{ $item->title }}</div>
          @if($item->description)<div class="td-ben-desc text-animation">{!! $item->description !!}</div>@endif
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- WHY CHOOSE US --}}
  @if($technology->whyUs->isNotEmpty())
  <section class="td-section">
    <div class="tf-container">
      <div class="row">
        <div class="col-lg-4">
          <div class="td-why-sticky">
            <div class="td-label">{{ $technology->whyUs->first()->section_heading ?? 'Why Choose Us' }}</div>
            <h2 class="td-heading mb-40">Reasons clients<span class="td-dim"> choose us</span></h2>
            <a href="{{ route('contact-us') }}" class="tf-btn"><span>Hire Us</span><i class="icon-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-7 offset-lg-1">
          @foreach($technology->whyUs as $item)
          <div class="td-why-item">
            <div class="td-why-title title-animation">{{ $item->title }}</div>
            @if($item->description)<div class="td-why-desc text-animation">{!! $item->description !!}</div>@endif
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- PROCESS --}}
  @if($technology->processes->isNotEmpty())
  <section class="td-section td-section--alt">
    <div class="tf-container">
      <div class="td-label">{{ $technology->processes->first()->section_heading ?? 'Our Process' }}</div>
      <h2 class="td-heading mb-0">How we build<span class="td-dim"> with {{ $technology->name }}</span></h2>
      <div class="td-proc-grid">
        @foreach($technology->processes as $item)
        <div class="td-proc-card">
          <div class="td-proc-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</div>
          <div class="td-proc-title title-animation">{{ $item->title }}</div>
          @if($item->description)<div class="td-proc-desc text-animation">{!! $item->description !!}</div>@endif
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- CONTACT FORM --}}
  <section class="section-contact p-contact tf-spacing-2">
    <div class="tf-container">
      <div class="section-contact-inner flex justify-content-between flex-wrap">
        <div class="left">
          <div class="heading-section mb-30">
            <div class="sub-title body-2 fw-7 mb-17 title-animation">Get In Touch</div>
            <h2 class="title fw-6 mb-10 title-animation">Let's Talk For<br><span class="fw-3">Your Next Project</span></h2>
          </div>
        </div>
        <div class="right">
          <form class="form-contact-us style-bg-dark-2 px-md-15" method="post" action="#">
            <div class="cols mb-37 g-30">
              <fieldset class="item">
                <label class="sub-title body-2 fw-5">Full Name</label>
                <fieldset class="position-relative"><i class="icon-user"></i><input type="text" name="name" placeholder="Your name" required></fieldset>
              </fieldset>
              <fieldset class="item">
                <label class="sub-title body-2 fw-5">Email Address</label>
                <fieldset class="position-relative"><i class="icon-email"></i><input type="email" name="email" placeholder="your@email.com" required></fieldset>
              </fieldset>
            </div>
            <fieldset class="mb-40">
              <label class="sub-title body-2 fw-5">Message</label>
              <textarea name="message" placeholder="Tell us about your project" required></textarea>
            </fieldset>
            <a href="{{ route('contact-us') }}" class="tf-btn"><span>Get A Free Consultation</span><i class="icon-arrow-right"></i></a>
          </form>
        </div>
      </div>
    </div>
  </section>

  {{-- FAQs --}}
  @if($technology->faqs->isNotEmpty())
  <section class="td-section">
    <div class="tf-container">
      <div class="row">
        <div class="col-lg-4 mb-50 mb-lg-0">
          <div class="td-label">{{ $technology->faqs->first()->section_heading ?? 'FAQ' }}</div>
          <h2 class="td-heading">Frequently<span class="td-dim"> asked questions</span></h2>
        </div>
        <div class="col-lg-7 offset-lg-1">
          <div id="tdFaqs">
            @foreach($technology->faqs as $faq)
            <div class="td-faq-item">
              <a href="#tdfaq-{{ $faq->id }}" data-bs-toggle="collapse" class="td-faq-toggle {{ $loop->first ? '' : 'collapsed' }}">
                <span>{{ $faq->question }}</span>
                <span class="td-faq-arrow">+</span>
              </a>
              <div id="tdfaq-{{ $faq->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#tdFaqs">
                <div class="td-faq-body">{!! $faq->answer !!}</div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- TECHNOLOGIES WE USE --}}
  @if($techStackGroups->isNotEmpty())
  <section class="td-section td-section--alt">
    <div class="tf-container">
      <div class="td-label">Stack</div>
      <h2 class="td-heading mb-60">Technologies<span class="td-dim"> we use</span></h2>
      @foreach($techStackGroups as $group)
      <div class="td-stack-group">
        <div class="td-stack-group-label">{{ $group->name }}</div>
        <div class="td-stack-items">
          @foreach($group->activeItems as $item)
          <div class="td-stack-item title-animation">
            @if($item->icon)
            <img src="{{ asset('storage/'.$item->icon) }}" alt="{{ $item->name }}">
            @else
            <div style="width:44px;height:44px;border-radius:8px;background:rgba(255,255,255,.06);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:rgba(255,255,255,.4);">{{ strtoupper(substr($item->name,0,2)) }}</div>
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
