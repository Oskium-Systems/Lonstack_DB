@extends('layouts.guest')
@section('content')

    <!-- Page Title -->
    <div class="page-title">
        <div class="tf-container">
            <div class="page-title-content text-center">
                <h1 class="title ml-11 split-text effect-right">
                    Client Testimonials
                </h1>
                <div class="breadkcum">
                    <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
                    <span class="dot"></span>
                    <span class="page-breadkcum body-2 fw-7 split-text effect-right">Testimonials</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content tf-spacing-2">

        <!-- Stats Bar -->
        <div class="tf-container mb-60">
            <div class="row rg-30 justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="text-center" style="border:1px solid var(--stroke-2); border-radius:12px; padding:35px 20px;">
                        <div class="flex justify-content-center fs-65 fw-7" style="color:var(--primary); line-height:1;">
                            1250<span>+</span>
                        </div>
                        <p class="body-2 fw-5 mt-15">Happy Clients</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center" style="border:1px solid var(--stroke-2); border-radius:12px; padding:35px 20px;">
                        <div class="flex justify-content-center fs-65 fw-7" style="color:var(--primary); line-height:1;">
                            98<span>%</span>
                        </div>
                        <p class="body-2 fw-5 mt-15">Satisfaction Rate</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center" style="border:1px solid var(--stroke-2); border-radius:12px; padding:35px 20px;">
                        <div class="flex justify-content-center fs-65 fw-7" style="color:var(--primary); line-height:1;">
                            850<span>+</span>
                        </div>
                        <p class="body-2 fw-5 mt-15">Projects Delivered</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center" style="border:1px solid var(--stroke-2); border-radius:12px; padding:35px 20px;">
                        <div class="flex justify-content-center fs-65 fw-7" style="color:var(--primary); line-height:1;">
                            9<span>+</span>
                        </div>
                        <p class="body-2 fw-5 mt-15">Years Experience</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Heading -->
        <div class="tf-container">
            <div class="heading-section mb-60 text-center">
                <div class="sub-title body-2 fw-7 mb-17 title-animation">
                    What Our Clients Say
                </div>
                <h2 class="title fw-6 title-animation">
                    Real Stories From
                    <span class="fw-3">Real Clients</span>
                </h2>
            </div>
        </div>

        <!-- Testimonial Cards Grid -->
        <section class="section-testimonial">
            <div class="mask mask-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="700" height="700" fill="none">
                    <circle cx="350" cy="350" r="285" stroke="url(#t1)" stroke-width="130" />
                    <defs>
                        <linearGradient id="t1" x1="154" x2="497.875" y1="61.688" y2="589.75">
                            <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
                            <stop offset="1" stop-color="#fff" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <div class="tf-container">
                <div class="row rg-30">

                    @forelse ($testimonials as $t)
                    <div class="col-xl-4 col-md-6">
                        <div class="testimonial-item style-2" style="display:flex; flex-direction:column; height:100%;">

                            <!-- Top: quote icon + avatar -->
                            <div class="top-item">
                                <div class="icon">
                                    <i class="icon-quote2"></i>
                                </div>
                                @if ($t->avatar)
                                    <img src="{{ asset('storage/' . $t->avatar) }}"
                                         alt="{{ $t->name }}" class="image-avatar"
                                         style="width:85px;height:85px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                                @else
                                    <div class="image-avatar d-flex align-items-center justify-content-center"
                                         style="background:var(--primary); color:var(--main-dark); font-weight:700; font-size:20px; width:85px; height:85px; border-radius:50%; flex-shrink:0;">
                                        {{ $t->initial }}
                                    </div>
                                @endif
                            </div>

                            <!-- Star Rating -->
                            <div class="mb-20" style="display:flex; gap:4px;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i style="font-size:15px; color:{{ $i <= $t->rating ? '#f5a623' : 'rgba(255,255,255,0.15)' }};">★</i>
                                @endfor
                            </div>

                            <!-- Quote -->
                            <div class="text lh-30" style="flex:1;">
                                "{{ $t->content }}"
                            </div>

                            <!-- Author -->
                            <div style="margin-top:24px; padding-top:20px; border-top:1px solid var(--stroke-2);">
                                <span class="name-user body-2 fw-6 d-block">{{ $t->name }}</span>
                                <span class="position text-medium d-block">
                                    {{ $t->position }}
                                    @if ($t->company)
                                        <span style="color:rgba(255,255,255,0.3);"> · </span>{{ $t->company }}
                                    @endif
                                </span>
                            </div>

                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" style="color:rgba(255,255,255,0.4);">
                        <i class="icon-quote2" style="font-size:48px; display:block; margin-bottom:16px; color:var(--primary);"></i>
                        <p class="body-2">No testimonials yet. Check back soon.</p>
                    </div>
                    @endforelse

                </div>
            </div>

            {{-- Pagination --}}
            @if ($testimonials->hasPages())
            <div class="tf-container" style="margin-top:70px; margin-bottom:20px;">
                <div class="row">
                    <div class="col-12">
                        <div class="wg-pagination flex justify-content-center" style="gap:12px;">
                            {{-- Prev --}}
                            @if ($testimonials->onFirstPage())
                                <span class="page-item disabled" style="opacity:0.4;">
                                    <span class="page-link" style="padding:10px 18px; font-size:16px;">&laquo;</span>
                                </span>
                            @else
                                <a href="{{ $testimonials->previousPageUrl() }}" class="page-item"
                                   style="padding:10px 18px; font-size:16px;">&laquo;</a>
                            @endif

                            {{-- Page numbers --}}
                            @foreach ($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                                @if ($page == $testimonials->currentPage())
                                    <span class="page-item active"
                                          style="padding:10px 18px; font-size:15px; font-weight:600;">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-item"
                                       style="padding:10px 18px; font-size:15px;">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if ($testimonials->hasMorePages())
                                <a href="{{ $testimonials->nextPageUrl() }}" class="page-item"
                                   style="padding:10px 18px; font-size:16px;">&raquo;</a>
                            @else
                                <span class="page-item disabled" style="opacity:0.4;">
                                    <span class="page-link" style="padding:10px 18px; font-size:16px;">&raquo;</span>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </section>

              <!-- CTA Strip -->
        <div class="tf-container tf-spacing-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div style="border:1px solid var(--stroke-2); border-radius:16px; padding:60px 40px;">
                        <div class="sub-title body-2 fw-7 mb-17">Ready to Work With Us?</div>
                        <h3 class="title fw-6 mb-30">
                            Join 1250+ Businesses That
                            <span class="fw-3">Trust LonStack</span>
                        </h3>
                        <a href="{{ route('contact-us') }}" class="tf-btn">
                            <span>Start Your Project</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── FAQ Section (SEO: FAQ Schema Markup) ─────────────── -->
        <div class="tf-container tf-spacing-3">
            <div class="row align-items-center rg-50">
                <div class="col-lg-8">

                    <div class="heading-section mb-50 text-center">
                        <div class="sub-title body-2 fw-7 mb-17 title-animation">Got Questions?</div>
                        <h2 class="title fw-6 title-animation">
                            Frequently Asked
                            <span class="fw-3">Questions</span>
                        </h2>
                    </div>

                    @php
                    $faqs = [
                        [
                            'q' => 'How long does it take to build a custom software project?',
                            'a' => 'Timelines vary by scope. A typical MVP takes 6–12 weeks. Enterprise platforms can range from 3–9 months. We provide a detailed project timeline during the discovery phase so you always know what to expect.',
                        ],
                        [
                            'q' => 'Do you offer post-launch support and maintenance?',
                            'a' => 'Yes. All our projects include a 30-day post-launch support window at no extra cost. We also offer ongoing maintenance retainers covering bug fixes, security patches, performance monitoring, and feature updates.',
                        ],
                        [
                            'q' => 'What industries do you specialize in?',
                            'a' => 'We have deep experience in fintech, healthcare, logistics, real estate, e-commerce, and Web3/blockchain. Our team understands the compliance, security, and scalability requirements unique to each sector.',
                        ],
                        [
                            'q' => 'Can I see examples of your previous work?',
                            'a' => 'Absolutely. Visit our Portfolio page to see case studies across different industries. We can also share relevant work samples under NDA during our initial consultation.',
                        ],
                        [
                            'q' => 'How do you handle project communication and updates?',
                            'a' => 'We assign a dedicated project manager to every engagement. You get weekly progress reports, access to a shared project board, and direct Slack/Teams communication with the development team throughout the project.',
                        ],
                        [
                            'q' => 'What is your pricing model?',
                            'a' => 'We offer fixed-price contracts for well-defined projects and time-and-materials billing for evolving scopes. We also provide dedicated team arrangements for long-term partnerships. Contact us for a tailored quote.',
                        ],
                    ];
                    @endphp

                    <div class="wg-according" id="faqAccordion">
                        @foreach ($faqs as $index => $faq)
                        <div class="according-item">
                            <h5 class="fw-5">
                                <a href="#faq{{ $index }}"
                                   data-bs-toggle="collapse"
                                   class="title-according {{ $index !== 0 ? 'collapsed' : '' }}">
                                    {{ $faq['q'] }}<span></span>
                                </a>
                            </h5>
                            <div id="faq{{ $index }}"
                                 class="collapse {{ $index === 0 ? 'show' : '' }}"
                                 data-bs-parent="#faqAccordion">
                                <div class="according-content">
                                    <div class="right">
                                        <div class="desc lh-30">{{ $faq['a'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>

                <!-- Illustration: person with question -->
                <div class="col-lg-4 d-none d-lg-flex justify-content-center align-items-center">
                    <div style="position:relative;width:100%;max-width:320px;">
                        <!-- Glow background -->
                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
                                    width:280px;height:280px;border-radius:50%;
                                    background:radial-gradient(circle,rgba(67,186,255,0.12) 0%,transparent 70%);
                                    pointer-events:none;"></div>
                        <svg viewBox="0 0 340 420" xmlns="http://www.w3.org/2000/svg"
                             style="width:100%;height:auto;position:relative;z-index:1;">

                            <!-- Floating question marks (background) -->
                            <text x="30"  y="60"  font-size="22" fill="#43baff" opacity="0.15" font-weight="700">?</text>
                            <text x="290" y="80"  font-size="16" fill="#43baff" opacity="0.12" font-weight="700">?</text>
                            <text x="15"  y="200" font-size="14" fill="#43baff" opacity="0.1"  font-weight="700">?</text>
                            <text x="310" y="300" font-size="18" fill="#43baff" opacity="0.12" font-weight="700">?</text>

                            <!-- Body / torso -->
                            <rect x="115" y="210" width="110" height="120" rx="22"
                                  fill="#1e3a4a" stroke="rgba(67,186,255,0.35)" stroke-width="1.5"/>

                            <!-- Left arm — raised up toward speech bubble -->
                            <path d="M115 228 Q68 200 72 158" stroke="#2a4a5e" stroke-width="16"
                                  stroke-linecap="round" fill="none"/>
                            <!-- Left hand -->
                            <circle cx="72" cy="153" r="12" fill="#2a4a5e" stroke="rgba(67,186,255,0.3)" stroke-width="1"/>
                            <!-- Finger pointing up -->
                            <line x1="72" y1="141" x2="72" y2="125" stroke="#43baff" stroke-width="5"
                                  stroke-linecap="round"/>

                            <!-- Right arm — relaxed down -->
                            <path d="M225 228 Q258 252 252 282" stroke="#1a2f3d" stroke-width="16"
                                  stroke-linecap="round" fill="none"/>
                            <ellipse cx="252" cy="288" rx="14" ry="9" rx="14" ry="9"
                                     fill="#1a2f3d" stroke="rgba(67,186,255,0.2)" stroke-width="1"/>

                            <!-- Neck -->
                            <rect x="155" y="183" width="30" height="30" rx="10" fill="#2a4a5e"/>

                            <!-- Head -->
                            <circle cx="170" cy="160" r="50" fill="#2a4a5e"
                                    stroke="rgba(67,186,255,0.3)" stroke-width="1.5"/>

                            <!-- Hair (simple arc) -->
                            <path d="M125 148 Q130 108 170 105 Q210 108 215 148"
                                  fill="#1a2f3d" stroke="rgba(67,186,255,0.2)" stroke-width="1"/>

                            <!-- Eyes — wide open (curious) -->
                            <ellipse cx="155" cy="158" rx="7" ry="8" fill="#43baff"/>
                            <ellipse cx="185" cy="158" rx="7" ry="8" fill="#43baff"/>
                            <!-- Pupils -->
                            <circle cx="156" cy="159" r="3.5" fill="#0d1f2b"/>
                            <circle cx="186" cy="159" r="3.5" fill="#0d1f2b"/>
                            <!-- Eye shine -->
                            <circle cx="158" cy="156" r="1.5" fill="white" opacity="0.8"/>
                            <circle cx="188" cy="156" r="1.5" fill="white" opacity="0.8"/>

                            <!-- Eyebrows — raised high (questioning) -->
                            <path d="M146 142 Q155 136 164 141" stroke="#43baff" stroke-width="3"
                                  stroke-linecap="round" fill="none"/>
                            <path d="M176 141 Q185 135 194 140" stroke="#43baff" stroke-width="3"
                                  stroke-linecap="round" fill="none"/>

                            <!-- Mouth — open O shape (surprised/questioning) -->
                            <ellipse cx="170" cy="178" rx="9" ry="7" fill="#0d1f2b"
                                     stroke="#43baff" stroke-width="1.5"/>

                            <!-- Legs -->
                            <rect x="125" y="325" width="32" height="68" rx="16"
                                  fill="#1a2f3d" stroke="rgba(67,186,255,0.2)" stroke-width="1"/>
                            <rect x="183" y="325" width="32" height="68" rx="16"
                                  fill="#1a2f3d" stroke="rgba(67,186,255,0.2)" stroke-width="1"/>

                            <!-- Shoes -->
                            <ellipse cx="141" cy="395" rx="24" ry="10" fill="#0d1f2b"/>
                            <ellipse cx="199" cy="395" rx="24" ry="10" fill="#0d1f2b"/>

                            <!-- Speech bubble (top right) -->
                            <rect x="190" y="48" width="130" height="90" rx="18"
                                  fill="#0d2535" stroke="#43baff" stroke-width="2"/>
                            <!-- Bubble tail pointing toward raised hand -->
                            <path d="M205 138 L188 162 L228 138" fill="#0d2535"
                                  stroke="#43baff" stroke-width="2" stroke-linejoin="round"/>

                            <!-- Large ? in bubble -->
                            <text x="255" y="115" text-anchor="middle"
                                  font-family="Inter,sans-serif" font-size="52" font-weight="800"
                                  fill="#43baff">?</text>

                            <!-- Small dots inside bubble (thinking dots) -->
                            <circle cx="218" cy="108" r="4" fill="#43baff" opacity="0.5"/>
                            <circle cx="232" cy="108" r="4" fill="#43baff" opacity="0.5"/>

                            <!-- Decorative floating dots -->
                            <circle cx="55"  cy="110" r="5" fill="#43baff" opacity="0.3"/>
                            <circle cx="40"  cy="145" r="3" fill="#43baff" opacity="0.2"/>
                            <circle cx="68"  cy="88"  r="4" fill="#43baff" opacity="0.22"/>
                            <circle cx="305" cy="210" r="4" fill="#43baff" opacity="0.22"/>
                            <circle cx="320" cy="245" r="3" fill="#43baff" opacity="0.15"/>
                            <circle cx="298" cy="170" r="5" fill="#43baff" opacity="0.18"/>
                        </svg>
                    </div>
                </div>

            </div>
        </div>

      

        {{-- FAQ JSON-LD Schema — helps Google show rich FAQ snippets in search results --}}
   @php
$schemaFaqs = [
    ['q' => 'How long does it take to build a custom software project?', 'a' => 'Timelines vary by scope. A typical MVP takes 6–12 weeks. Enterprise platforms can range from 3–9 months. We provide a detailed project timeline during the discovery phase so you always know what to expect.'],
    ['q' => 'Do you offer post-launch support and maintenance?', 'a' => 'Yes. All our projects include a 30-day post-launch support window at no extra cost. We also offer ongoing maintenance retainers covering bug fixes, security patches, performance monitoring, and feature updates.'],
    ['q' => 'What industries do you specialize in?', 'a' => 'We have deep experience in fintech, healthcare, logistics, real estate, e-commerce, and Web3/blockchain. Our team understands the compliance, security, and scalability requirements unique to each sector.'],
    ['q' => 'Can I see examples of your previous work?', 'a' => 'Absolutely. Visit our Portfolio page to see case studies across different industries. We can also share relevant work samples under NDA during our initial consultation.'],
    ['q' => 'How do you handle project communication and updates?', 'a' => 'We assign a dedicated project manager to every engagement. You get weekly progress reports, access to a shared project board, and direct Slack/Teams communication with the development team throughout the project.'],
    ['q' => 'What is your pricing model?', 'a' => 'We offer fixed-price contracts for well-defined projects and time-and-materials billing for evolving scopes. We also provide dedicated team arrangements for long-term partnerships. Contact us for a tailored quote.'],
];

$faqSchema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(fn($sf) => [
        '@type'          => 'Question',
        'name'           => $sf['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $sf['a']],
    ], $schemaFaqs),
];
@endphp

<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>

    

    </div>
    <!-- /.Main Content -->

@endsection
