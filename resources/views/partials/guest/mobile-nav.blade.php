<div class="offcanvas offcanvas-start mobile-nav-wrap" id="canvasMobile">
  <div class="inner-mobile-nav">
    <div class="top-header-mobi">
      <div class="logo-mobile">
        <a href="{{ route('home') }}">
          <img src="{{ asset('image/logo/logo.png') }}" alt="Logo">
        </a>
      </div>
      <button class="mobile-nav-close" data-bs-dismiss="offcanvas" aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" width="20px" height="20px"
          viewBox="0 0 122.878 122.88">
          <g>
            <path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"></path>
          </g>
        </svg>
      </button>
    </div>

    <nav class="mobile-main-nav">
      <ul id="menu-mobile" class="menu">

        <li class="menu-item">
          <a href="{{ route('home') }}">Home</a>
        </li>

        <li class="menu-item">
          <a href="{{ route('about') }}">About Us</a>
        </li>

        {{-- Services — dynamic categories and services from DB --}}
        <li class="menu-item menu-item-has-children-mobile">
          <a href="#mobile-services" data-bs-toggle="collapse" class="collapsed">Services</a>
          <div id="mobile-services" class="collapse" data-bs-parent="#menu-mobile">
            <ul class="sub-menu-mobile">
              <li class="menu-item">
                <a href="{{ route('services') }}">All Services</a>
              </li>
              @foreach($navCategories as $category)
              {{-- Category header --}}
              <li class="menu-item" style="padding: 6px 16px; font-size:11px; text-transform:uppercase; letter-spacing:.08em; opacity:.5; pointer-events:none;">
                {{ $category->name }}
              </li>
              @foreach($category->activeServices as $service)
              <li class="menu-item">
                <a href="{{ route('services.show', $service->slug) }}">
                  {{ $service->name }}
                  @if($service->badge === 'hot') 🔥
                  @elseif($service->badge === 'new') <span style="font-size:10px;background:#43baff;color:#fff;padding:1px 5px;border-radius:3px;">NEW</span>
                  @endif
                </a>
              </li>
              @endforeach
              @endforeach
            </ul>
          </div>
        </li>

        <li class="menu-item menu-item-has-children-mobile">
          <a href="#mobile-company" data-bs-toggle="collapse" class="collapsed">Company</a>
          <div id="mobile-company" class="collapse" data-bs-parent="#menu-mobile">
            <ul class="sub-menu-mobile">
              <li class="menu-item"><a href="{{ route('about') }}">About Us</a></li>
              <li class="menu-item"><a href="{{ route('career') }}">Career</a></li>
              <li class="menu-item"><a href="{{ route('faq') }}">FAQ</a></li>
              <li class="menu-item"><a href="{{ route('press') }}">Press</a></li>
              <li class="menu-item"><a href="{{ route('testimonials') }}">Testimonials</a></li>
              <li class="menu-item"><a href="{{ route('awards') }}">Awards</a></li>
            </ul>
          </div>
        </li>

        <li class="menu-item">
          <a href="{{ route('portfolio') }}">Portfolio</a>
        </li>

        <li class="menu-item">
          <a href="{{ route('blogs') }}">Blog</a>
        </li>

        <li class="menu-item">
          <a href="{{ route('contact-us') }}">Contact Us</a>
        </li>

      </ul>

      {{-- Contact info from settings if available --}}
      @php $settings = app(\App\Models\Setting::class)::first(); @endphp
      @if($settings)
      <div class="contact-mobile">
        <h5 class="title-contact-mobile">Contact Info</h5>
        <ul class="mb-20">
          @if($settings->company_address)
          <li class="content-contact-moblile">
            <i class="icon-location-dot"></i>
            <a href="#" class="text-medium">{{ $settings->company_address }}</a>
          </li>
          @endif
          @if($settings->company_email)
          <li class="content-contact-moblile">
            <i class="icon-email"></i>
            <a href="mailto:{{ $settings->company_email }}" class="text-medium">{{ $settings->company_email }}</a>
          </li>
          @endif
          @if($settings->company_phone)
          <li class="content-contact-moblile">
            <i class="icon-phone"></i>
            <a href="tel:{{ $settings->company_phone }}" class="text-medium">{{ $settings->company_phone }}</a>
          </li>
          @endif
        </ul>
        <ul class="post-social">
          @if($settings->site_fb)<li><a href="{{ $settings->site_fb }}" class="icon-social" target="_blank"><i class="icon-fb"></i></a></li>@endif
          @if($settings->site_twitter)<li><a href="{{ $settings->site_twitter }}" class="icon-social" target="_blank"><i class="icon-X"></i></a></li>@endif
          @if($settings->site_linkedin)<li><a href="{{ $settings->site_linkedin }}" class="icon-social" target="_blank"><i class="icon-linkedin"></i></a></li>@endif
          @if($settings->site_youtube)<li><a href="{{ $settings->site_youtube }}" class="icon-social" target="_blank"><i class="icon-youtube"></i></a></li>@endif
        </ul>
      </div>
      @endif
    </nav>
  </div>
</div>