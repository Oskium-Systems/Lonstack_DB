<header class="header header-sticky" id="header">
    <div class="header-content flex justify-content-between align-items-center">
        <div class="header-left flex align-items-center">
            <div class="logo logo-header">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('image/logo/logo.png') }}" alt="">
                </a>
            </div>
            <nav class="main-menu">
                <ul class="menu-primary-menu">

                    {{-- ── SERVICES ── --}}
                    <li class="menu-item menu-item-has-children position-relative">
                        <a href="javascript:void(0)" class="item-link body-2"><span>Services</span></a>

                        <div class="sub-menu sub-menu-large">
                            <div class="mega-menu-inner">

                                {{-- Left Sidebar --}}
                                <div class="mega-menu-sidebar">
                                    <ul class="mega-menu-categories">
                                        <li class="mega-cat-item active" data-tab="web3">
                                            <span>Web3 Services</span><i class="icon-arrow-right"></i>
                                        </li>
                                        <li class="mega-cat-item" data-tab="software">
                                            <span>Software Development Services</span><i class="icon-arrow-right"></i>
                                        </li>
                                        <li class="mega-cat-item" data-tab="ai">
                                            <span>AI Services</span><i class="icon-arrow-right"></i>
                                        </li>
                                        <li class="mega-cat-item" data-tab="data">
                                            <span>Data & Analytics Services</span><i class="icon-arrow-right"></i>
                                        </li>

                                        <li class="mega-cat-item">
                                            <a href="{{ route('services.staff-augmentation') }}"
                                                style="display:flex; justify-content:space-between; align-items:center; width:100%; text-decoration:none; color:inherit;">
                                                <span>Staff Augmentation</span><i class="icon-arrow-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                {{-- Right Content --}}
                                <div class="mega-menu-content">

                                    {{-- Web3 Tab --}}
                                    <div class="mega-tab active" id="tab-web3">
                                        <div class="header-desktop--services-list">
                                            <a href="{{ route('services.blockchain') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Blockchain Development <span
                                                            class="badge-hot">HOT 🔥</span></span>
                                                    <span class="mega-service-desc">Robust and efficient blockchain
                                                        software across various industries</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.web3') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Web3 Development</span>
                                                    <span class="mega-service-desc">Empower your project with Web3
                                                        technology for improved security, greater accountability, and
                                                        transparency</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.crypto-exchange') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Crypto Exchange Development <span
                                                            class="badge-hot">HOT 🔥</span></span>
                                                    <span class="mega-service-desc">Seamless transactions to buy, sell,
                                                        exchange and trade various cryptocurrencies</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.crypto-wallet') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Crypto Wallet Development</span>
                                                    <span class="mega-service-desc">Tap into the advantages of crypto
                                                        wallet designed to meet your unique requirements</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.dex') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">DEX Development</span>
                                                    <span class="mega-service-desc">Create your very own Decentralized
                                                        Exchange with the assistance of our experienced team</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.nft') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">NFT Marketplace Development</span>
                                                    <span class="mega-service-desc">Creating an NFT marketplace is a
                                                        profitable solution for your enterprise</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.smart-contract') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Smart Contract Development</span>
                                                    <span class="mega-service-desc">Advanced solutions that provide
                                                        transparent and efficient transactions</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.p2p') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">P2P Crypto Exchange
                                                        Development</span>
                                                    <span class="mega-service-desc">Build a robust and scalable
                                                        peer-to-peer crypto exchange</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Software Tab --}}
                                    <div class="mega-tab" id="tab-software">
                                        <div class="header-desktop--services-list">
                                            <a href="{{ route('services.custom-software') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Custom Software Development <span
                                                            class="badge-hot">HOT 🔥</span></span>
                                                    <span class="mega-service-desc">Cover all your business needs with
                                                        tailor-made solutions</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.web-app') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Web Application Development</span>
                                                    <span class="mega-service-desc">Delivering custom web solutions to
                                                        help your business skyrocket</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.mobile-app') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Mobile App Development <span
                                                            class="badge-hot">HOT 🔥</span></span>
                                                    <span class="mega-service-desc">Design, develop, and launch
                                                        high-performing mobile apps for iOS and Android</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.ux-ui') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">UX/UI & Web Design Services</span>
                                                    <span class="mega-service-desc">User-friendly, intuitive, and
                                                        catchy design for your software</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.cloud-devops') }}" class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Cloud & DevOps Engineering</span>
                                                    <span class="mega-service-desc">Reliable cloud infrastructure and
                                                        DevOps pipelines for stable, scalable deployments</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.product-discovery') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Product Discovery</span>
                                                    <span class="mega-service-desc">Idea validation, scope definition,
                                                        and technical feasibility</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.dedicated-team') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Dedicated Development Team</span>
                                                    <span class="mega-service-desc">Empower your project with
                                                        experienced tech experts</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.staff-augmentation') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Staff Augmentation</span>
                                                    <span class="mega-service-desc">Scale your team on demand with
                                                        skilled developers integrated into your workflow</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.prediction-market') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Prediction Market Development
                                                        <span class="badge-new">NEW</span></span>
                                                    <span class="mega-service-desc">Full-cycle prediction market
                                                        software for crypto</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- AI Tab --}}
                                    <div class="mega-tab" id="tab-ai">
                                        <div class="header-desktop--services-list">
                                            <a href="{{ route('services.ai-consulting') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">AI Consulting</span>
                                                    <span class="mega-service-desc">Strategic AI advisory to help your
                                                        business leverage machine learning</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.ai-development') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">AI Development</span>
                                                    <span class="mega-service-desc">Custom AI solutions built to
                                                        automate, predict, and transform your business</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Data Tab --}}
                                    <div class="mega-tab" id="tab-data">
                                        <div class="header-desktop--services-list">
                                            <a href="{{ route('services.data-analytics') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Data Analytics</span>
                                                    <span class="mega-service-desc">Transform raw data into actionable
                                                        business insights</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('services.data-engineering') }}"
                                                class="mega-service-item">
                                                <div class="mega-service-text">
                                                    <span class="mega-service-title">Data Engineering</span>
                                                    <span class="mega-service-desc">Build scalable data pipelines and
                                                        infrastructure for your business</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

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
                                        <div class="award-item"><img src="{{ asset('image/awards/award-1.png') }}"
                                                alt="Award"></div>
                                        <div class="award-item"><img src="{{ asset('image/awards/award-2.png') }}"
                                                alt="Award"></div>
                                        <div class="award-item"><img src="{{ asset('image/awards/award-3.png') }}"
                                                alt="Award"></div>
                                        <div class="award-item"><img src="{{ asset('image/awards/award-4.png') }}"
                                                alt="Award"></div>
                                    </div>
                                </div>
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
                                                <span class="mega-service-desc">We are looking for a soulmate, not just
                                                    an employee</span>
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
                                                <span class="mega-service-desc">Media features, interviews and industry
                                                    coverage</span>
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

                    {{-- ── TECHNOLOGIES ── --}}
                    <li class="menu-item menu-item-has-children position-relative">
                        <a href="javascript:void(0)" class="item-link body-2"><span>Technologies</span></a>

                        <div class="sub-menu sub-menu-large">
                            <div class="mega-menu-inner">
                                <div class="mega-menu-sidebar mega-menu-sidebar--promo">
                                    <div class="promo-card">
                                        <div class="promo-card-image">
                                            <img src="{{ asset('image/promo/cex-whitelabel.png') }}"
                                                alt="CEX White-Label Solution">
                                        </div>
                                        <h4 class="promo-card-title">CEX White-Label Solution</h4>
                                        <p class="promo-card-desc">Launch your own branded crypto exchange with our
                                            white-label solution. Secure, scalable, and customizable.</p>
                                        <a href="{{ route('services') }}" class="promo-card-btn">
                                            <span>Learn More</span><i class="ti ti-arrow-up-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="mega-menu-content">
                                    <div class="header-desktop--services-list">
                                        <a href="{{ route('tech.nodejs') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Node.js Development</span>
                                                <span class="mega-service-desc">Accelerate development with scalable
                                                    and flexible Node.js solutions.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.reactjs') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">React JS Development</span>
                                                <span class="mega-service-desc">Diverse applications from Single Page
                                                    Applications (SPAs) and more.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.react-native') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">React Native Development</span>
                                                <span class="mega-service-desc">Advanced React Native solutions for
                                                    businesses of all sizes.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.solidity') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Solidity Development</span>
                                                <span class="mega-service-desc">Powerful dApps, smart contracts, and
                                                    blockchain Solidity solutions.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.solana') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Solana Development</span>
                                                <span class="mega-service-desc">Top Solana blockchain software
                                                    development with our expert team.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.expressjs') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Express.js Development</span>
                                                <span class="mega-service-desc">Quality mobile and web apps with this
                                                    powerful JS framework.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.laravel') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Laravel Development</span>
                                                <span class="mega-service-desc">Explore the full potential of your web
                                                    project with expert Laravel developers.</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('tech.nestjs') }}"
                                            class="mega-service-item mega-service-item--no-icon">
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">NestJS Development</span>
                                                <span class="mega-service-desc">Fast and high-performing web
                                                    applications built with NestJS.</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- ── INDUSTRIES ── --}}
                    <li class="menu-item menu-item-has-children position-relative">
                        <a href="javascript:void(0)" class="item-link body-2"><span>Industries</span></a>

                        <div class="sub-menu sub-menu-large">
                            <div class="mega-menu-inner">
                                <div class="mega-menu-content" style="width:100%">
                                    <div class="header-desktop--services-list">
                                        <a href="{{ route('industries.oil-gas') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-flame"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Oil & Gas</span>
                                                <span class="mega-service-desc">Streamline upstream and midstream with
                                                    tech solutions</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.logistics') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-truck"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Logistics</span>
                                                <span class="mega-service-desc">Enhance speed and accuracy with
                                                    real-time data analytics</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.fintech') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-credit-card"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Fintech</span>
                                                <span class="mega-service-desc">Tailored solutions to lower costs and
                                                    improve retention</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.retail') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-shopping-bag"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Retail</span>
                                                <span class="mega-service-desc">Redefine UX and drive business growth
                                                    with expertise</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.real-estate') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-building-estate"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Real Estate</span>
                                                <span class="mega-service-desc">Improve timelines and resources with
                                                    digital solutions</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.travel') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-plane"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Travel & Hospitality</span>
                                                <span class="mega-service-desc">Deliver hyper-personalized, hassle-free
                                                    user experiences</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.media') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-device-tv"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Media & Entertainment</span>
                                                <span class="mega-service-desc">Enhance content delivery and user
                                                    experience with tech</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.healthcare') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-heart-rate-monitor"></i>
                                            </div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Healthcare</span>
                                                <span class="mega-service-desc">Streamline healthcare with cutting-edge
                                                    digital solutions</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.elearning') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-school"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">eLearning</span>
                                                <span class="mega-service-desc">Transform learning with engaging,
                                                    results-driven solutions</span>
                                            </div>
                                        </a>
                                        <a href="{{ route('industries.manufacturing') }}" class="mega-service-item">
                                            <div class="mega-service-icon"><i class="ti ti-tools"></i></div>
                                            <div class="mega-service-text">
                                                <span class="mega-service-title">Manufacturing</span>
                                                <span class="mega-service-desc">Smarter manufacturing processes for
                                                    faster business growth</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- ── PORTFOLIO ── --}}
                    <li class="menu-item {{ request()->routeIs('portfolio') ? 'current-menu-item' : '' }}">
                        <a href="{{ route('portfolio') }}" class="item-link body-2"><span>Portfolio</span></a>
                    </li>

                    {{-- ── BLOG ── --}}
                    <li class="menu-item {{ request()->routeIs('blogs') ? 'current-menu-item' : '' }}">
                        <a href="{{ route('blogs') }}" class="item-link body-2"><span>Blog</span></a>
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
                    <div class="burger"><span></span><span></span><span></span></div>
                </a>
            </div>
            <div class="mobile-button nav-item d-xl-none">
                <a href="#canvasMobile" data-bs-toggle="offcanvas">
                    <span></span><span></span><span></span>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    document.querySelectorAll('.mega-cat-item').forEach(function(cat) {
        cat.addEventListener('mouseenter', function() {
            document.querySelectorAll('.mega-cat-item').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.mega-tab').forEach(el => el.classList.remove('active'));
            this.classList.add('active');
            const target = document.getElementById('tab-' + this.dataset.tab);
            if (target) target.classList.add('active');
        });
    });

</script>
