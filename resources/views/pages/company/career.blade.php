@extends('layouts.guest')

@section('content')

    <!-- Page-title -->
    <div class="page-title">
        <div class="tf-container">
            <div class="page-title-content text-center">
                <h1 class="title split-text effect-right">Careers</h1>
                <div class="breadkcum">
                    <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
                    <span class="dot"></span>
                    <span class="page-breadkcum body-2 fw-7 split-text effect-right">Vacancies</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-title -->

    <!-- Main-content -->
    <div class="main-content tf-spacing-2">

        <!-- ── Hero Tagline ──────────────────────────────────────── -->
        <div class="tf-container">
            <div class="text-center" style="max-width:720px; margin:0 auto 70px;">
                <h2 class="title fw-7 title-animation" style="font-size:clamp(28px,4vw,48px); line-height:1.25;">
                    In Lonstack, we seek
                    <em class="fw-3" style="color:var(--primary); font-style:italic;">soulmate</em>
                    for the mission, not just 
                    <em class="fw-3" style="color:var(--primary); font-style:italic;">employee</em> for the position.
                </h2>
            </div>
        </div>

        <!-- ── Open Positions ────────────────────────────────────── -->
        <div class="tf-container">

            @if ($jobs->isNotEmpty())
            <!-- Count label -->
            <div class="sub-title body-2 fw-7 mb-30 title-animation"
                 style="letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,0.45);">
                {{ $jobs->total() }} Available position(s){{ $jobs->total() !== 1 ? 's' : '' }}
            </div>

            <!-- Job rows -->
            <div style="border-top:1px solid var(--stroke-2);">
                @foreach ($jobs as $job)
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;
                            gap:16px; padding:28px 0; border-bottom:1px solid var(--stroke-2);">

                    <!-- Left: title + meta -->
                    <div>
                        <h4 class="fw-6 mb-10" style="font-size:18px; line-height:1.4;">
                            {{ $job->title }}
                            @if ($job->is_featured)
                                🔥
                            @endif
                        </h4>
                        <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
                            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
                                <i class="icon-location-dot" style="color:var(--primary); font-size:14px;"></i>
                                {{ $job->location }}
                            </span>
                            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
                                <i class="icon-briefcase" style="color:var(--primary); font-size:14px;"></i>
                                {{ $job->employment_label }}
                            </span>
                            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
                                <i class="icon-globe" style="color:var(--primary); font-size:14px;"></i>
                                {{ $job->work_type_label }}
                            </span>
                            @if ($job->experience_level)
                            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.45); font-size:13px;">
                                <i class="icon-chart-line" style="color:var(--primary); font-size:14px;"></i>
                                {{ $job->experience_level }}
                            </span>
                            @endif
                            @if ($job->deadline)
                            <span style="display:flex; align-items:center; gap:6px;
                                         color:rgba(255,255,255,0.35); font-size:12px;">
                                <i class="icon-clock" style="font-size:13px;"></i>
                                Closes {{ $job->deadline->format('d M Y') }}
                            </span>
                            @endif
                        </div>
                        @if ($job->excerpt)
                        <p style="margin-top:8px; font-size:13px; color:rgba(255,255,255,0.4);
                                  line-height:1.6; max-width:560px;">
                            {{ $job->excerpt }}
                        </p>
                        @endif
                        @if ($job->tags)
                        <div style="display:flex; flex-wrap:wrap; gap:6px; margin-top:10px;">
                            @foreach ($job->tags as $tag)
                            <span style="font-size:11px; font-weight:600; letter-spacing:.04em;
                                         padding:3px 10px; border-radius:20px;
                                         background:rgba(67,186,255,0.1);
                                         color:var(--primary); border:1px solid rgba(67,186,255,0.2);">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Right: CTA -->
                    <a href="#apply-form"
                       style="display:inline-flex; align-items:center; gap:8px;
                              font-size:13px; font-weight:700; letter-spacing:.06em;
                              text-transform:uppercase; color:var(--primary);
                              text-decoration:none; white-space:nowrap; flex-shrink:0;">
                        APPLY NOW
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                </div>
                @endforeach
            </div>
            {{-- ── Pagination ── --}}
            @if ($jobs->hasPages())
            <div class="wg-pagination flex justify-content-center" style="gap:12px; margin-top:50px;">

                {{-- Prev --}}
                @if ($jobs->onFirstPage())
                    <span class="page-item disabled" style="opacity:0.35; pointer-events:none;">
                        <span class="page-link" style="padding:10px 18px; font-size:16px;">&laquo;</span>
                    </span>
                @else
                    <a href="{{ $jobs->previousPageUrl() }}" class="page-item"
                       style="padding:10px 18px; font-size:16px;">&laquo;</a>
                @endif

                {{-- Page numbers --}}
                @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                    @if ($page == $jobs->currentPage())
                        <span class="page-item active"
                              style="padding:10px 18px; font-size:15px; font-weight:600;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-item"
                           style="padding:10px 18px; font-size:15px;">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($jobs->hasMorePages())
                    <a href="{{ $jobs->nextPageUrl() }}" class="page-item"
                       style="padding:10px 18px; font-size:16px;">&raquo;</a>
                @else
                    <span class="page-item disabled" style="opacity:0.35; pointer-events:none;">
                        <span class="page-link" style="padding:10px 18px; font-size:16px;">&raquo;</span>
                    </span>
                @endif

            </div>
            @endif

            @else
            {{-- ── No open positions state ── --}}
            <div style="border:1px solid var(--stroke-2); border-radius:20px;
                        padding:70px 40px; text-align:center; margin-bottom:20px;">

                {{-- Animated icon --}}
                <div style="width:80px; height:80px; border-radius:50%;
                            background:rgba(67,186,255,0.08); border:1px solid rgba(67,186,255,0.2);
                            display:flex; align-items:center; justify-content:center;
                            margin:0 auto 28px;">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <path d="M12 18h12M18 12v12" stroke="rgba(67,186,255,0.4)"
                              stroke-width="2" stroke-linecap="round"/>
                        <rect x="2" y="8" width="32" height="22" rx="4"
                              stroke="rgba(67,186,255,0.5)" stroke-width="1.5" fill="none"/>
                        <path d="M12 8V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"
                              stroke="rgba(67,186,255,0.5)" stroke-width="1.5"
                              stroke-linecap="round"/>
                    </svg>
                </div>

                <h3 class="fw-6 mb-15" style="font-size:22px;">
                    No open positions right now
                </h3>
                <p style="color:rgba(255,255,255,0.45); font-size:15px; line-height:1.8;
                           max-width:480px; margin:0 auto 32px;">
                    We're not actively hiring at the moment, but great talent is always welcome.
                    Send us your profile and we'll reach out when the right opportunity opens up.
                </p>

                {{-- Bullet points --}}
                <div style="display:inline-flex; flex-direction:column; gap:12px;
                            text-align:left; margin-bottom:36px;">
                    @foreach ([
                        'Drop your CV and we\'ll keep it on file',
                        'We\'ll notify you when a matching role opens',
                        'No commitment — just a conversation',
                    ] as $point)
                    <div style="display:flex; align-items:center; gap:12px;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;">
                            <circle cx="8" cy="8" r="7" stroke="rgba(67,186,255,0.4)" stroke-width="1.2"/>
                            <path d="M5 8l2.5 2.5L11 5.5" stroke="var(--primary)"
                                  stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span style="font-size:14px; color:rgba(255,255,255,0.55);">{{ $point }}</span>
                    </div>
                    @endforeach
                </div>

                <br>
                <a href="#apply-form" class="tf-btn">
                    <span>Send Your Profile</span>
                    <i class="icon-arrow-right"></i>
                </a>
            </div>
            @endif

        </div>

        <!-- ── "Haven't found a vacancy?" strip ─────────────────── -->
        @if ($jobs->isNotEmpty())
        <div class="tf-container tf-spacing-3">
            <div class="text-center" style="padding:60px 0; border-top:1px solid var(--stroke-2);
                                            border-bottom:1px solid var(--stroke-2);">
                <p class="body-1 fw-5 mb-20" style="font-size:20px;">
                    Haven't found a vacancy but want to join Lonstack?
                </p>
                <a href="#apply-form"
                   style="display:inline-flex; align-items:center; gap:8px; font-size:14px; font-weight:700;
                          letter-spacing:.06em; text-transform:uppercase; color:var(--primary);
                          text-decoration:none; border-bottom:1px solid var(--primary); padding-bottom:2px;">
                    WRITE US
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
        @endif

        <!-- ── Why Join Us ───────────────────────────────────────── -->
        {{-- <div class="tf-container tf-spacing-3">
            <div class="heading-section mb-60 text-center">
                <div class="sub-title body-2 fw-7 mb-17 title-animation">Why Lonstack</div>
                <h2 class="title fw-6 title-animation">
                    A Place Where You <span class="fw-3">Actually Grow</span>
                </h2>
            </div>
            <div class="row rg-30">
                @php
                $perks = [
                    ['icon' => 'icon-rocket',      'title' => 'Exciting Projects',  'desc' => 'Work on real-world blockchain, fintech, and SaaS products that ship to thousands of users.'],
                    ['icon' => 'icon-globe',        'title' => '100% Remote',        'desc' => 'Work from anywhere in the world. We care about output, not office hours.'],
                    ['icon' => 'icon-chart-line',   'title' => 'Career Growth',      'desc' => 'Regular 1-on-1s, clear promotion paths, and a budget for courses and conferences.'],
                    ['icon' => 'icon-users',        'title' => 'Great Team',         'desc' => 'Collaborate with senior engineers who love clean code, good docs, and honest feedback.'],
                    ['icon' => 'icon-clock',        'title' => 'Flexible Hours',     'desc' => 'Async-first culture. Overlap a few hours with the team and own the rest of your day.'],
                    ['icon' => 'icon-shield-check', 'title' => 'Competitive Pay',    'desc' => 'Market-rate salaries reviewed annually, plus performance bonuses for top contributors.'],
                ];
                @endphp
                @foreach ($perks as $perk)
                <div class="col-lg-4 col-md-6">
                    <div style="border:1px solid var(--stroke-2); border-radius:16px; padding:36px 30px; height:100%;">
                        <div style="width:52px; height:52px; border-radius:12px; background:rgba(67,186,255,0.1);
                                    display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                            <i class="{{ $perk['icon'] }}" style="font-size:22px; color:var(--primary);"></i>
                        </div>
                        <h5 class="fw-6 mb-12" style="font-size:17px;">{{ $perk['title'] }}</h5>
                        <p class="lh-30" style="color:rgba(255,255,255,0.55); font-size:14px;">{{ $perk['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div> --}}

        <!-- ── Apply / Work Inquiry — section-form style ─────────── -->
        <section id="apply-form" class="section-form tf-spacing-4">
            <div class="section-inner flex">

                <!-- Left panel: image + heading -->
                <div class="left">
                    <div class="image tf-animate-1">
                        <img src="{{ asset('image/section/img-section-form-1.jpg') }}"
                             data-src="{{ asset('image/section/img-section-form-1.jpg') }}"
                             alt="Work with Lonstack" class="lazyload">
                    </div>
                    <div class="section-content section-form-content tf-animate-2">
                        <div class="sub-title body-2 fw-7 mb-17">Work Inquiry</div>
                        <h2 class="title fw-6">
                            Let's Work For your<br>Next Projects?
                        </h2>
                        <a href="{{ route('contact-us') }}" class="tf-btn style-bg-white hover-bg-main-dark">
                            <span>Contact Us</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Right panel: form -->
                <div class="right">

                    @if (session('success'))
                    <div style="background:rgba(67,186,255,0.1); border:1px solid var(--primary);
                                border-radius:12px; padding:18px 24px; margin-bottom:30px;
                                display:flex; align-items:center; gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 22 22" fill="none">
                            <circle cx="11" cy="11" r="10" stroke="var(--primary)" stroke-width="1.5"/>
                            <path d="M6.5 11l3 3 6-6" stroke="var(--primary)" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span style="color:var(--primary); font-size:14px; font-weight:600;">
                            {{ session('success') }}
                        </span>
                    </div>
                    @endif

                    <form id="careerForm" class="form-contact-us px-md-15"
                          method="POST" action="{{ route('career.apply') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="heading-form text-center">
                            <h3 class="title">Need Help For Project!</h3>
                            <div class="desc lh-30">We are ready to help your next projects, let's work together</div>
                        </div>

                        <!-- Row 1: Name + Email -->
                        <div class="cols mb-20 g-20">
                            <fieldset class="item">
                                <input type="text" name="name" id="career_name"
                                       placeholder="Name" required>
                                <i class="icon-user"></i>
                            </fieldset>
                            <fieldset class="item">
                                <input type="email" name="email" id="career_email"
                                       placeholder="Email" required>
                                <i class="icon-email"></i>
                            </fieldset>
                        </div>

                        <!-- Row 2: Phone with country code + Telegram -->
                        <div class="cols mb-20 g-20">
                            <!-- Phone with country-code dropdown -->
                            <fieldset class="item" style="position:relative;">
                                <div style="display:flex; align-items:stretch; gap:0;">
                                    <!-- Country code selector -->
                                    <div class="career-country-wrap" style="position:relative; flex-shrink:0;">
                                        <button type="button" id="countryBtn"
                                                style="display:flex; align-items:center; gap:6px; height:100%;
                                                       padding:0 12px; background:rgba(22, 2, 2, 0.06);
                                                       border:none; border-right:1px solid rgba(255,255,255,0.12);
                                                       border-radius:8px 0 0 8px; cursor:pointer;
                                                       color:inherit; font-size:13px; font-weight:600;
                                                       white-space:nowrap; min-width:90px;">
                                            <span id="countryFlag">🇺🇸</span>
                                            <span id="countryCode">+1</span>
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                                                <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <!-- Dropdown list -->
                                        <div id="countryDropdown"
                                             style="display:none; position:absolute; top:calc(100% + 4px); left:0;
                                                    background:#0d2535; border:1px solid rgba(255,255,255,0.12);
                                                    border-radius:10px; min-width:200px; max-height:220px;
                                                    overflow-y:auto; z-index:999; box-shadow:0 8px 24px rgba(0,0,0,0.4);">
                                            @php
                                            $countries = [
                                                ['flag'=>'🇺🇸','code'=>'+1',   'name'=>'United States'],
                                                ['flag'=>'🇬🇧','code'=>'+44',  'name'=>'United Kingdom'],
                                                ['flag'=>'🇳🇬','code'=>'+234', 'name'=>'Nigeria'],
                                                ['flag'=>'🇬🇭','code'=>'+233', 'name'=>'Ghana'],
                                                ['flag'=>'🇿🇦','code'=>'+27',  'name'=>'South Africa'],
                                                ['flag'=>'🇰🇪','code'=>'+254', 'name'=>'Kenya'],
                                                ['flag'=>'🇨🇦','code'=>'+1',   'name'=>'Canada'],
                                                ['flag'=>'🇦🇺','code'=>'+61',  'name'=>'Australia'],
                                                ['flag'=>'🇩🇪','code'=>'+49',  'name'=>'Germany'],
                                                ['flag'=>'🇫🇷','code'=>'+33',  'name'=>'France'],
                                                ['flag'=>'🇮🇳','code'=>'+91',  'name'=>'India'],
                                                ['flag'=>'🇧🇷','code'=>'+55',  'name'=>'Brazil'],
                                                ['flag'=>'🇦🇪','code'=>'+971', 'name'=>'UAE'],
                                                ['flag'=>'🇸🇬','code'=>'+65',  'name'=>'Singapore'],
                                                ['flag'=>'🇵🇱','code'=>'+48',  'name'=>'Poland'],
                                                ['flag'=>'🇺🇦','code'=>'+380', 'name'=>'Ukraine'],
                                            ];
                                            @endphp
                                            @foreach ($countries as $c)
                                            <div class="country-option"
                                                 data-flag="{{ $c['flag'] }}" data-code="{{ $c['code'] }}"
                                                 style="display:flex; align-items:center; gap:10px; padding:10px 14px;
                                                        cursor:pointer; font-size:13px; transition:background .15s;"
                                                 onmouseover="this.style.background='rgba(67,186,255,0.1)'"
                                                 onmouseout="this.style.background='transparent'">
                                                <span>{{ $c['flag'] }}</span>
                                                <span style="color:rgba(255,255,255,0.5);">{{ $c['code'] }}</span>
                                                <span>{{ $c['name'] }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                        <input type="hidden" name="phone_code" id="phoneCode" value="+1">
                                    </div>
                                    <!-- Phone number input -->
                                    <input type="tel" name="phone" id="career_phone"
                                           placeholder="+1 912 345 678" required
                                           style="flex:1; border-radius:0 8px 8px 0; padding-left:14px;">
                                </div>
                            </fieldset>

                            <!-- Telegram -->
                            <fieldset class="item">
                                <input type="text" name="telegram" id="career_telegram"
                                       placeholder="@username">
                                <i class="icon-send" style="font-size:15px;"></i>
                            </fieldset>
                        </div>

                        <!-- Row 3: Budget + How did you hear -->
                        <div class="cols mb-20 g-20">
                            <!-- Budget dropdown -->
                            <div class="nice-select" style="flex:1;" tabindex="0">
                                <span class="current caption-1">What is your budget?</span>
                                <ul class="list">
                                    <li class="option option-all selected focus">What is your budget?</li>
                                    <li class="option">Less than $5,000</li>
                                    <li class="option">$5,000 – $15,000</li>
                                    <li class="option">$15,000 – $50,000</li>
                                    <li class="option">$50,000 – $100,000</li>
                                    <li class="option">$100,000+</li>
                                    <li class="option">Not sure yet</li>
                                </ul>
                            </div>
                            <!-- How did you hear -->
                            <div class="nice-select" style="flex:1;" tabindex="0">
                                <span class="current caption-1">How did you hear about us?</span>
                                <ul class="list">
                                    <li class="option option-all selected focus">How did you hear about us?</li>
                                    <li class="option">Google / Search Engine</li>
                                    <li class="option">LinkedIn</li>
                                    <li class="option">Twitter / X</li>
                                    <li class="option">Facebook / Instagram</li>
                                    <li class="option">Referral / Friend</li>
                                    <li class="option">Blog / Article</li>
                                    <li class="option">Other</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Describe Your Idea textarea -->
                        <fieldset class="mb-20">
                            <textarea name="message" id="career_message" rows="4"
                                      placeholder="Describe your idea *" required></textarea>
                        </fieldset>

                        <!-- File upload (Drag & Drop) -->
                        <div class="mb-20">
                            <label for="career_file" id="dropZone"
                                   style="display:flex; align-items:center; gap:16px; cursor:pointer;
                                          border:1px dashed rgba(67,186,255,0.45); border-radius:10px;
                                          padding:20px 22px; transition:border-color .2s, background .2s;
                                          background:rgba(67,186,255,0.07);">
                                <div style="width:42px; height:42px; border-radius:10px;
                                            background:rgba(67,186,255,0.1); display:flex;
                                            align-items:center; justify-content:center; flex-shrink:0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                         stroke="var(--primary)" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <polyline points="17 8 12 3 7 8"/>
                                        <line x1="12" y1="3" x2="12" y2="15"/>
                                    </svg>
                                </div>
                                <div>
                                    <span style="font-size:14px; font-weight:600;">
                                        Drag &amp; Drop Your Files or
                                        <span style="color:var(--primary);">Browse</span>
                                    </span>
                                    <p style="font-size:12px; color:rgba(14, 13, 13, 0.4); margin:4px 0 0;">
                                        You can upload ZIP, PDF, PAGES, DOC, or DOCX up to 8 MB each.
                                    </p>
                                </div>
                                <input type="file" id="career_file" name="cv_file"
                                       accept=".pdf,.doc,.docx,.zip,.pages" style="display:none;">
                            </label>
                            <p id="file-name-display"
                               style="font-size:12px; color:var(--primary); margin-top:6px; display:none;"></p>
                        </div>

                        <button type="submit" class="tf-btn mx-auto">
                            <span>SEND</span>
                            <i class="icon-arrow-right"></i>
                        </button>

                    </form>
                </div>
                <!-- /.right -->

            </div>
        </section>
        <!-- /.section-form -->

    </div>
    <!-- /.main-content -->

@push('scripts')
<script>
(function () {
    // ── File name display ──────────────────────────────────
    var fileInput   = document.getElementById('career_file');
    var fileDisplay = document.getElementById('file-name-display');
    var dropZone    = document.getElementById('dropZone');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            fileDisplay.textContent = '📎 ' + this.files[0].name;
            fileDisplay.style.display = 'block';
        }
    });

    // Drag-over highlight
    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        this.style.borderColor  = 'var(--primary)';
        this.style.background   = 'rgba(67,186,255,0.05)';
    });
    dropZone.addEventListener('dragleave', function () {
        this.style.borderColor = 'rgba(67,186,255,0.45)';
        this.style.background  = 'rgba(67,186,255,0.07)';
    });
    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        this.style.borderColor = 'rgba(67,186,255,0.45)';
        this.style.background  = 'rgba(67,186,255,0.07)';
        var dt = e.dataTransfer;
        if (dt.files && dt.files[0]) {
            fileInput.files = dt.files;
            fileDisplay.textContent = '📎 ' + dt.files[0].name;
            fileDisplay.style.display = 'block';
        }
    });

    // ── Country code dropdown ──────────────────────────────
    var btn      = document.getElementById('countryBtn');
    var dropdown = document.getElementById('countryDropdown');
    var flagEl   = document.getElementById('countryFlag');
    var codeEl   = document.getElementById('countryCode');
    var codeInput= document.getElementById('phoneCode');

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });

    document.querySelectorAll('.country-option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            flagEl.textContent  = this.dataset.flag;
            codeEl.textContent  = this.dataset.code;
            codeInput.value     = this.dataset.code;
            dropdown.style.display = 'none';
        });
    });

    document.addEventListener('click', function () {
        dropdown.style.display = 'none';
    });
})();
</script>
@endpush

@endsection
