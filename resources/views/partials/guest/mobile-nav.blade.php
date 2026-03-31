 <div class="offcanvas offcanvas-start mobile-nav-wrap" id="canvasMobile">
            <div class="inner-mobile-nav">
                <div class="top-header-mobi">
                    <div class="logo-mobile">
                        <a href="index.html">
                            <img src="image/logo/logo.svg" alt="">
                        </a>
                    </div>
                    <button class="mobile-nav-close" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            fill="white" x="0px" y="0px" width="20px" height="20px"
                            viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88"
                            xml:space="preserve">
                            <g>
                                <path
                                    d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
                <nav class="mobile-main-nav">
                    <ul id="menu-mobile" class="menu">
                        <li class="menu-item current-menu-mobile-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('about') }}">About Us</a>
                        </li>
                      
                        <li class="menu-item menu-item-has-children-mobile">
                            <a href="#dropdown-menu-2" data-bs-toggle="collapse" class="collapsed">Services</a>
                            <div id="dropdown-menu-2" class="collapse" data-bs-parent="#menu-mobile">
                                <ul class="sub-menu-mobile">
                                    <li class="menu-item"><a href="services.html">Services</a></li>
                                    <li class="menu-item"><a href="services-details.html">Services Details</a></li>
                                </ul>
                            </div>
                        </li>


                        <li class="menu-item menu-item-has-children-mobile">
                            <a href="#dropdown-menu-4" data-bs-toggle="collapse" class="collapsed">Pages</a>
                            <div id="dropdown-menu-4" class="collapse" data-bs-parent="#menu-mobile">
                                <ul class="sub-menu-mobile" id="sub-menu-mobile-1">
                                    <li class="menu-item"><a href="team.html">Team</a></li>
                                    <li class="menu-item"><a href="faq.html">FAQs</a></li>
                                    <li class="menu-item"><a href="pricing.html">Pricing Plan</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item menu-item-has-children-mobile">
                            <a href="#dropdown-menu-6" data-bs-toggle="collapse" class="collapsed">Blog</a>
                            <div id="dropdown-menu-6" class="collapse" data-bs-parent="#menu-mobile">
                                <ul class="sub-menu-mobile">
                                    <li class="menu-item"><a href="blog-standard.html">Blog Standard</a></li>
                                    <li class="menu-item"><a href="blog-list.html">Blog List</a></li>
                                    <li class="menu-item"><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item">
                            <a href="contact.html">Contact Us</a>
                        </li>
                    </ul>
                    <div class="contact-mobile">
                        <h5 class="title-contact-mobile">Contact Info</h5>
                        <ul class="mb-20">
                            <li class="content-contact-moblile"><i class="icon-location-dot"></i> <a
                                    href="#" class="text-medium">55 Main Street, San Francisco, California,
                                    USA</a>
                            </li>
                            <li class="content-contact-moblile">
                                <i class="icon-email"></i><a href="mailto:example@gmail.com"
                                    class="text-medium">themesflat@gmail.com</a>
                            </li>
                            <li class="content-contact-moblile">
                                <i class="icon-phone"></i><a href="tel:+1123456889" class="text-medium">+1 (123)
                                    456 889</a>
                            </li>
                        </ul>

                        <ul class="post-social">
                            <li><a href="#" class="icon-social"><i class="icon-fb"></i></a></li>
                            <li><a href="#" class="icon-social"><i class="icon-X"></i></a></li>
                            <li><a href="#" class="icon-social"><i class="icon-linkedin"></i></a></li>
                            <li><a href="#" class="icon-social"><i class="icon-youtube"></i></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
