<footer class="footer" id="footer">
    <div class="mask mask-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
            <circle cx="400" cy="400" r="325" stroke="url(#a6)" stroke-width="150" />
            <defs>
                <linearGradient id="a6" x1="176" x2="569" y1="70.5" y2="674">
                    <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
                    <stop offset="1" stop-color="#fff" stop-opacity="0" />
                </linearGradient>
            </defs>
        </svg>
    </div>
    <div class="mask mask-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none">
            <circle cx="400" cy="400" r="325" stroke="url(#a7)" stroke-width="150" />
            <defs>
                <linearGradient id="a7" x1="176" x2="569" y1="70.5" y2="674">
                    <stop offset="0" stop-color="#fff" stop-opacity="0.05" />
                    <stop offset="1" stop-color="#fff" stop-opacity="0" />
                </linearGradient>
            </defs>
        </svg>
    </div>
    <div class="footer-inner position-relative">
        <div class="footer-top">
            <div class="tf-marquee">
                <div class="marquee-wrapper">
                    <div class="initial-child-container">

                        <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
                        </div>
                        <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
                        </div>
                        <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
                        </div>
                        <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
                        </div>
                        <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
                        </div>
                        <div class="big-text">Let's Build Together <span class="text-stroke">Start a Project</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tf-container">
            <div class="footer-middle flex justify-content-between">

                <div class="left">
                    <div class="footer-logo mb-20">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('image/logo/logo.png') }}" alt="Logo"
                                style="height: 50px; width: auto;">
                        </a>
                    </div>

                    <p class="text mb-20" style="max-width: 480px; line-height: 1.7;">
                        At LonStack, we are committed to delivering excellence through technology. Our team of experts partners with businesses to craft intelligent, reliable, and scalable digital experiences that stand the test of time.
                    </p>

                    <form class="form-newsletter form-footer">
                        <div class="title fs-32 fw-7">
                            Subscribe <span class="fw-4">Newsletter</span>
                        </div>
                    </form>

                    <div class="sib-form mb-23">
                        <div id="sib-form-container" class="sib-form-container">
                            <div id="sib-container" class="sib-container--large sib-container--vertical">
                                <form id="sib-form" method="POST" action="" data-type="subscription">
                                    <div style="display: none;">
                                        <div class="sib-form-block">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div style="display: none;">
                                        <div class="sib-form-block">
                                            <div class="sib-text-form-block">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: none;">
                                        <div class="sib-optin sib-form-block">
                                            <div class="form__entry entry_mcq">
                                                <div class="form__label-row">
                                                    <div class="entry__choice">
                                                        <label>
                                                            <input type="checkbox" class="input_replaced" value="1"
                                                                id="OPT_IN" name="OPT_IN" />
                                                            <span class="checkbox checkbox_tick_positive"></span>
                                                            <span>
                                                                <p></p>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <label class="entry__error entry__error--primary"></label>
                                                <label class="entry__specification"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="sib-input sib-form-block">
                                            <div class="form__entry entry_block">
                                                <div class="form__label-row">
                                                    <label class="entry__label" for="EMAIL"></label>
                                                    <div class="entry__field">
                                                        <i class="icon-email"></i>
                                                        <input class="input" type="text" id="EMAIL"
                                                            name="EMAIL" autocomplete="off"
                                                            placeholder="Email Address" data-required="true"
                                                            required />
                                                    </div>
                                                </div>
                                                <label class="entry__error entry__error--primary"></label>
                                                <label class="entry__specification"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="sib-form-block">
                                            <button
                                                class="sib-form-block__button sib-form-block__button-with-loader tf-btn hover-bg-white flex-grow-1"
                                                form="sib-form" type="submit">
                                                <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon"
                                                    viewBox="0 0 512 512">
                                                    <path
                                                        d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                </svg>
                                                <span>Sign Up</span>
                                                <i class="icon-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="text" name="email_address_check" value=""
                                        class="input--hidden">
                                    <input type="hidden" name="locale" value="en">
                                </form>
                            </div>
                        </div>
                    </div>

                    <p class="text">
                        By subscribing, you're accept <a href="{{route('privacy-policy')}}" class="fw-7">Privacy Policy</a>
                    </p>
                </div>

                <div class="footer-content footer-col-block">
                    <div class="title-mobile body-2">
                        Services
                        <i class="icon-angle-down"></i>
                    </div>
                    <div class="tf-collapse-content" style="display: unset;">
                        <ul>
                            <li class="support-item-footer"><a href="{{ route('services.blockchain') }}">Blockchain
                                    Development</a></li>
                            <li class="support-item-footer"><a href="{{ route('services.web3') }}">Web3
                                    Development</a></li>
                            <li class="support-item-footer"><a href="{{ route('services.mobile-app') }}">Mobile App
                                    Development</a></li>
                            <li class="support-item-footer"><a href="{{ route('services.custom-software') }}">Custom
                                    Software</a></li>
                            <li class="support-item-footer"><a href="{{ route('services.ai-development') }}">AI
                                    Development</a></li>
                            <li class="support-item-footer"><a href="{{ route('services.ux-ui') }}">UX/UI Design</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="locations-contact">
                    <div class="locations-footer item mb-30">
                        <div class="title body-2 fw-5">Locations</div>
                        <div class="address body-2 lh-30">
                            55 Main Street, 2nd block<br>Malborne, Australia
                        </div>
                    </div>
                    <div class="contact-footer item">
                        <div class="title body-2 fw-5">Contact</div>
                        <div>
                            <h6><a href="#" class="fw-5">support@gmail.com</a></h6>
                            <h4 class="lh-45 fw-6"><a href="#" class="mb-0">+880 (123) 456 88</a></h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="tf-container">
            <div class="footer-bottom">
                <div class="line"></div>
                <a href="#" class="footer-go-top">
                    <i class="icon-arrow-up"></i>
                </a>
                <div class="list-bottom flex align-items-center justify-content-between flex-wrap rg-15 g-30">
                    <span class="text-center lh-30">
                        © {{ date('Y') }} <a href="#" class="fw-7">LonStack</a> - IT Services. All rights
                        reserved.
                    </span>
                    <ul class="flex align-items-center justify-content-center flex-wrap rg-15">
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
