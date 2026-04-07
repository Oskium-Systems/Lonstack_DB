 <header class="header header-sticky" id="header">
     <div class="header-content flex justify-content-between align-items-center">
         <div class="header-left flex align-items-center">
             <div class="logo logo-header">
                 <a href="{{ route('home') }}">
                     <img src="image/logo/logo.svg" alt="">
                 </a>
             </div>
             <nav class="main-menu">
                 <ul class="menu-primary-menu">

                     <li class="menu-item menu-item-has-children position-relative">
                         <a href="javascript:void(0)" class="item-link body-2">
                             <span>Services</span>
                         </a>

                         <div class="sub-menu sub-menu-large">
                             <div class="mega-menu-inner">

                                 <!-- Left Sidebar: Categories -->
                                 <div class="mega-menu-sidebar">
                                     <ul class="mega-menu-categories">
                                         <li class="mega-cat-item active" data-tab="web3">
                                             <span>Web3 Services</span>
                                             <i class="icon-arrow-right"></i>
                                         </li>
                                         <li class="mega-cat-item" data-tab="software">
                                             <span>Software Development Services</span>
                                             <i class="icon-arrow-right"></i>
                                         </li>
                                         <li class="mega-cat-item" data-tab="ai">
                                             <span>AI Services</span>
                                             <i class="icon-arrow-right"></i>
                                         </li>
                                         <li class="mega-cat-item" data-tab="data">
                                             <span>Data & Analytics Services</span>
                                             <i class="icon-arrow-right"></i>
                                         </li>
                                     </ul>
                                 </div>

                                 <!-- Right Content: Grid of services -->
                                 <div class="mega-menu-content">

                                     <!-- Web3 Tab -->
                                     <div class="mega-tab active" id="tab-web3">
                                         <div class="header-desktop--services-list">
                                             <a href="#" class="mega-service-item">

                                                 {{-- <div class="mega-service-icon"><i class="ti ti-currency-bitcoin"></i></div> --}}

                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Blockchain Development <span
                                                             class="badge-hot">HOT 🔥</span></span>
                                                     <span class="mega-service-desc">Robust and efficient blockchain
                                                         software across various industries</span>
                                                 </div>
                                             </a>
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Web3 Development</span>
                                                     <span class="mega-service-desc">Empower your project with Web3
                                                         technology for greater accountability</span>
                                                 </div>
                                             </a>
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Crypto Exchange Development <span
                                                             class="badge-hot">HOT 🔥</span></span>
                                                     <span class="mega-service-desc">Seamless transactions to buy, sell,
                                                         exchange and trade cryptocurrencies</span>
                                                 </div>
                                             </a>
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Crypto Wallet Development</span>
                                                     <span class="mega-service-desc">Tap into the advantages of crypto
                                                         wallet designed for your needs</span>
                                                 </div>
                                             </a>
                                         </div>
                                     </div>

                                     <!-- Software Tab -->
                                     <div class="mega-tab" id="tab-software">
                                         <div class="header-desktop--services-list">
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Custom Software Development</span>
                                                     <span class="mega-service-desc">Tailored software solutions built
                                                         for your specific business needs</span>
                                                 </div>
                                             </a>
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Mobile App Development</span>
                                                     <span class="mega-service-desc">Native and cross-platform apps for
                                                         iOS and Android</span>
                                                 </div>
                                             </a>
                                             <!-- Add more items as needed -->
                                         </div>
                                     </div>

                                     <!-- AI Tab -->
                                     <div class="mega-tab" id="tab-ai">
                                         <div class="header-desktop--services-list">
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">AI Consulting</span>
                                                     <span class="mega-service-desc">Strategic AI advisory to help your
                                                         business leverage machine learning</span>
                                                 </div>
                                             </a>
                                             <!-- Add more items -->
                                         </div>
                                     </div>

                                     <!-- Data Tab -->
                                     <div class="mega-tab" id="tab-data">
                                         <div class="header-desktop--services-list">
                                             <a href="#" class="mega-service-item">
                                                 <div class="mega-service-text">
                                                     <span class="mega-service-title">Data Analytics</span>
                                                     <span class="mega-service-desc">Transform raw data into actionable
                                                         business insights</span>
                                                 </div>
                                             </a>
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                     </li>

                     <li class="menu-item menu-item-has-children position-relative">
                         <a href="javascript:void(0)" class="item-link body-2">
                             <span>Company</span>
                         </a>

                         <div class="sub-menu sub-menu-large">
                             <div class="mega-menu-inner">

                                 <!-- Left: Awards/Badges Grid -->
                                 <div class="mega-menu-sidebar mega-menu-sidebar--awards">
                                     <div class="awards-grid">
                                         <div class="award-item">
                                             <img src="{{ asset('image/awards/award-1.png') }}" alt="Award">
                                         </div>
                                         <div class="award-item">
                                             <img src="{{ asset('image/awards/award-2.png') }}" alt="Award">
                                         </div>
                                         <div class="award-item">
                                             <img src="{{ asset('image/awards/award-3.png') }}" alt="Award">
                                         </div>
                                         <div class="award-item">
                                             <img src="{{ asset('image/awards/award-4.png') }}" alt="Award">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Right: Company Links Grid -->
                                 <div class="mega-menu-content">
                                     <div class="header-desktop--services-list">

                                         <a href="{{ route('about') }}" class="mega-service-item">
                                             <div class="mega-service-icon"><i class="ti ti-building"></i></div>
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">About Us</span>
                                                 <span class="mega-service-desc">Learn who we are, what we do, and why
                                                     clients trust us</span>
                                             </div>
                                         </a>

                                         <a href="{{ route('career') }}" class="mega-service-item">
                                             <div class="mega-service-icon"><i class="ti ti-briefcase"></i></div>
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Career</span>
                                                 <span class="mega-service-desc">We are looking for a soulmate, not
                                                     just an employee</span>
                                             </div>
                                         </a>

                                         <a href="{{ route('faq') }}" class="mega-service-item">
                                             <div class="mega-service-icon"><i class="ti ti-message-question"></i>
                                             </div>
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">FAQ</span>
                                                 <span class="mega-service-desc">Answers to the most frequently asked
                                                     questions</span>
                                             </div>
                                         </a>

                                         <a href="{{ route('press') }}" class="mega-service-item">
                                             <div class="mega-service-icon"><i class="ti ti-news"></i></div>
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Press</span>
                                                 <span class="mega-service-desc">Media features, interviews and
                                                     industry coverage</span>
                                             </div>
                                         </a>

                                         <a href="{{ route('testimonials') }}" class="mega-service-item">
                                             <div class="mega-service-icon"><i class="ti ti-quote"></i></div>
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Testimonials</span>
                                                 <span class="mega-service-desc">See what our clients say about working
                                                     with us</span>
                                             </div>
                                         </a>

                                         <a href="{{ route('awards') }}" class="mega-service-item">
                                             <div class="mega-service-icon"><i class="ti ti-trophy"></i></div>
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Awards</span>
                                                 <span class="mega-service-desc">World-renowned awards we have earned
                                                     over the years</span>
                                             </div>
                                         </a>

                                     </div>
                                 </div>

                             </div>
                         </div>
                     </li>

                     <li class="menu-item menu-item-has-children position-relative">
                         <a href="javascript:void(0)" class="item-link body-2">
                             <span>Technologies</span>
                         </a>

                         <div class="sub-menu sub-menu-large">
                             <div class="mega-menu-inner">

                                 <!-- Left: Featured Promo Card -->
                                 <div class="mega-menu-sidebar mega-menu-sidebar--promo">
                                     <div class="promo-card">
                                         <div class="promo-card-image">
                                             <img src="{{ asset('image/promo/cex-whitelabel.png') }}"
                                                 alt="CEX White-Label Solution">
                                         </div>
                                         <h4 class="promo-card-title">CEX White-Label Solution</h4>
                                         <p class="promo-card-desc">
                                             Launch your own branded crypto exchange with our white-label solution.
                                             Secure, scalable, and customizable for seamless trading experiences.
                                         </p>
                                         <a href="{{ route('services') }}" class="promo-card-btn">
                                             <span>Learn More</span>
                                             <i class="ti ti-arrow-up-right"></i>
                                         </a>
                                     </div>
                                 </div>

                                 <!-- Right: Technologies List (no icons) -->
                                 <div class="mega-menu-content">
                                     <div class="header-desktop--services-list">

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Node.js Development</span>
                                                 <span class="mega-service-desc">Accelerate your development process
                                                     with up-to-date Node.js technology to get enhanced, scalable, and
                                                     flexible solutions.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">React JS Development</span>
                                                 <span class="mega-service-desc">We use the power of React.js to
                                                     develop diverse applications, from Single Page Applications (SPAs)
                                                     and more.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">React Native Development</span>
                                                 <span class="mega-service-desc">Delivering advanced React Native
                                                     solutions to both small businesses and large corporations.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Solidity Development</span>
                                                 <span class="mega-service-desc">We build powerful dApps, smart
                                                     contracts, and blockchain Solidity solutions.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Solana Development</span>
                                                 <span class="mega-service-desc">Get top Solana blockchain software
                                                     development services with our expert team.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Express.js Development</span>
                                                 <span class="mega-service-desc">We create quality mobile and web apps
                                                     with the help of this powerful JS framework.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">Laravel Development</span>
                                                 <span class="mega-service-desc">Explore the full potential of your web
                                                     project with our experienced Laravel developers.</span>
                                             </div>
                                         </a>

                                         <a href="#" class="mega-service-item mega-service-item--no-icon">
                                             <div class="mega-service-text">
                                                 <span class="mega-service-title">NestJS Development</span>
                                                 <span class="mega-service-desc">With NestJS, we create fast and
                                                     high-performing web applications.</span>
                                             </div>
                                         </a>

                                     </div>
                                 </div>

                             </div>
                         </div>
                     </li>

                     {{--
                     <li class="menu-item {{ request()->routeIs('about') ? 'current-menu-item' : '' }}">
                         <a href="{{ route('about') }}" class="item-link body-2">
                             <span>About Us</span>
                         </a>
                     </li> --}}

                     <li class="menu-item">
                         <a href="" class="item-link body-2">
                             <span>Portfolio</span>
                         </a>
                     </li>


                     <li class="menu-item {{ request()->routeIs('blogs') ? 'current-menu-item' : '' }}">
                         <a href="{{ route('blogs') }}" class="item-link body-2">
                             <span>Blog</span>
                         </a>
                     </li>


                 </ul>
             </nav>
         </div>
         <div class="header-right">
             <div class="nav-btn">
                 <a href="{{ route('contact-us') }}" class="tf-btn">
                     <span>Get in Touch</span>
                     <i class="icon-arrow-right"></i>
                 </a>
             </div>
             <div class="nav-megamenu">
                 <a href="#canvnasMegamenu" data-bs-toggle="offcanvas" class="megamenu-btn">
                     <div class="burger">
                         <span></span>
                         <span></span>
                         <span></span>
                     </div>
                 </a>
             </div>
             <div class="mobile-button nav-item d-xl-none">
                 <a href="#canvasMobile" data-bs-toggle="offcanvas">
                     <span></span>
                     <span></span>
                     <span></span>
                 </a>
             </div>
         </div>
     </div>
 </header>

 <script>
     document.querySelectorAll('.mega-cat-item').forEach(function(cat) {
         cat.addEventListener('mouseenter', function() {
             // Remove active from all cats and tabs
             document.querySelectorAll('.mega-cat-item').forEach(el => el.classList.remove('active'));
             document.querySelectorAll('.mega-tab').forEach(el => el.classList.remove('active'));

             // Activate hovered cat and matching tab
             this.classList.add('active');
             const tabId = 'tab-' + this.dataset.tab;
             const target = document.getElementById(tabId);
             if (target) target.classList.add('active');
         });
     });
 </script>
