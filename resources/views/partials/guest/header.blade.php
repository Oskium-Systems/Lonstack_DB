<header class="header header-sticky" id="header">
  <div class="header-content flex justify-content-between align-items-center">
    <div class="header-left flex align-items-center">
      <div class="logo logo-header">
        <a href="{{ route('home') }}">
          <img src="{{ asset('image/logo/logo.png') }}" alt="Logo">
        </a>
      </div>
      <nav class="main-menu">
        <ul class="menu-primary-menu">

          {{-- ── SERVICES — dynamic from DB ── --}}
          <li class="menu-item menu-item-has-children position-relative">
            <a href="{{ route('services') }}" class="item-link body-2"><span>Services</span></a>

            <div class="sub-menu sub-menu-large">
              <div class="mega-menu-inner">

                {{-- Left sidebar: category list --}}
                <div class="mega-menu-sidebar">
                  <ul class="mega-menu-categories">
                    @foreach($navCategories as $index => $category)
                    <li class="mega-cat-item {{ $index === 0 ? 'active' : '' }}"
                      data-tab="cat-{{ $category->id }}">
                      <span>{{ $category->name }}</span>
                      <i class="icon-arrow-right"></i>
                    </li>
                    @endforeach
                  </ul>
                </div>

                {{-- Right content: services per category --}}
                <div class="mega-menu-content">
                  @foreach($navCategories as $index => $category)
                  <div class="mega-tab {{ $index === 0 ? 'active' : '' }}"
                    id="cat-{{ $category->id }}">
                    <div class="header-desktop--services-list">
                      @foreach($category->activeServices as $service)
                      <a href="{{ route('services.show', $service->slug) }}"
                        class="mega-service-item">
                        <div class="mega-service-text">
                          <span class="mega-service-title">
                            {{ $service->name }}
                            @if($service->badge === 'hot')
                            <span class="badge-hot">HOT 🔥</span>
                            @elseif($service->badge === 'new')
                            <span class="badge-new">NEW</span>
                            @endif
                          </span>
                          <span class="mega-service-desc">
                            {{ $service->short_description }}
                          </span>
                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div>
                  @endforeach
                </div>

              </div>
            </div>
          </li>

          {{-- ── COMPANY ── --}}
          <li class="menu-item menu-item-has-children position-relative">
            <a href="javascript:void(0)" class="item-link body-2"><span>Company</span></a>

            <div class="sub-menu sub-menu-large">
              <div class="mega-menu-inner">
                <div class="mega-menu-sidebar mega-menu-sidebar--awards">
                  <div class="awards-grid">
                    <div class="award-item"><img src="{{ asset('image/awards/award-1.png') }}" alt="Award"></div>
                    <div class="award-item"><img src="{{ asset('image/awards/award-2.png') }}" alt="Award"></div>
                    <div class="award-item"><img src="{{ asset('image/awards/award-3.png') }}" alt="Award"></div>
                    <div class="award-item"><img src="{{ asset('image/awards/award-4.png') }}" alt="Award"></div>
                  </div>
                </div>
                <div class="mega-menu-content">
                  <div class="header-desktop--services-list">
                    <a href="{{ route('about') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-building"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">About Us</span>
                        <span class="mega-service-desc">Learn who we are, what we do, and why clients trust us</span>
                      </div>
                    </a>
                    <a href="{{ route('career') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-briefcase"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">Career</span>
                        <span class="mega-service-desc">We are looking for a soulmate, not just an employee</span>
                      </div>
                    </a>
                    <a href="{{ route('faq') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-message-question"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">FAQ</span>
                        <span class="mega-service-desc">Answers to the most frequently asked questions</span>
                      </div>
                    </a>
                    <a href="{{ route('press') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-news"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">Press</span>
                        <span class="mega-service-desc">Media features, interviews and industry coverage</span>
                      </div>
                    </a>
                    <a href="{{ route('testimonials') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-quote"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">Testimonials</span>
                        <span class="mega-service-desc">See what our clients say about working with us</span>
                      </div>
                    </a>
                    <a href="{{ route('awards') }}" class="mega-service-item">
                      <div class="mega-service-icon"><i class="ti ti-trophy"></i></div>
                      <div class="mega-service-text">
                        <span class="mega-service-title">Awards</span>
                        <span class="mega-service-desc">World-renowned awards we have earned over the years</span>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          {{-- ── TECHNOLOGIES ── --}}
          <li class="menu-item menu-item-has-children position-relative">
            <a href="javascript:void(0)" class="item-link body-2"><span>Technologies</span></a>

            <div class="sub-menu sub-menu-large">
              <div class="mega-menu-inner">
                <div class="mega-menu-sidebar mega-menu-sidebar--promo">
                  <div class="promo-card">
                    <div class="promo-card-image">
                      <img src="{{ asset('image/promo/cex-whitelabel.png') }}" alt="CEX White-Label Solution">
                    </div>
                    <h4 class="promo-card-title">CEX White-Label Solution</h4>
                    <p class="promo-card-desc">Launch your own branded crypto exchange with our white-label solution. Secure, scalable, and customizable.</p>
                    <a href="{{ route('services') }}" class="promo-card-btn">
                      <span>Learn More</span><i class="ti ti-arrow-up-right"></i>
                    </a>
                  </div>
                </div>
                <div class="mega-menu-content">
                  <div class="header-desktop--services-list">
                    <a href="{{ route('tech.nodejs') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">Node.js Development</span>
                        <span class="mega-service-desc">Accelerate development with scalable and flexible Node.js solutions.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.reactjs') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">React JS Development</span>
                        <span class="mega-service-desc">Diverse applications from Single Page Applications (SPAs) and more.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.react-native') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">React Native Development</span>
                        <span class="mega-service-desc">Advanced React Native solutions for businesses of all sizes.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.solidity') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">Solidity Development</span>
                        <span class="mega-service-desc">Powerful dApps, smart contracts, and blockchain Solidity solutions.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.solana') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">Solana Development</span>
                        <span class="mega-service-desc">Top Solana blockchain software development with our expert team.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.expressjs') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">Express.js Development</span>
                        <span class="mega-service-desc">Quality mobile and web apps with this powerful JS framework.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.laravel') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">Laravel Development</span>
                        <span class="mega-service-desc">Elegant PHP solutions built on the most popular modern framework.</span>
                      </div>
                    </a>
                    <a href="{{ route('tech.nestjs') }}" class="mega-service-item mega-service-item--no-icon">
                      <div class="mega-service-text">
                        <span class="mega-service-title">NestJS Development</span>
                        <span class="mega-service-desc">Scalable server-side applications with a structured Node.js framework.</span>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          {{-- ── PORTFOLIO ── --}}
          <li class="menu-item">
            <a href="{{ route('portfolio') }}" class="item-link body-2"><span>Portfolio</span></a>
          </li>

          {{-- ── BLOG ── --}}
          <li class="menu-item">
            <a href="{{ route('blogs') }}" class="item-link body-2"><span>Blog</span></a>
          </li>

          {{-- ── CONTACT ── --}}
          <li class="menu-item">
            <a href="{{ route('contact-us') }}" class="item-link body-2"><span>Contact</span></a>
          </li>

        </ul>
      </nav>
    </div>

    <div class="header-right flex align-items-center">
      <a href="{{ route('contact-us') }}" class="tf-btn style-1">
        <span>Get In Touch</span>
      </a>
      <div class="burger-menu" data-bs-toggle="offcanvas" data-bs-target="#canvasMobile">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>
</header>