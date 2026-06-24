@extends('layouts.guest')
@section('content')
    <!-- Page-title -->
    <div class="page-title">
        <div class="tf-container">
            <div class="page-title-content text-center">
                <h1 class="title split-text effect-right">
                    Contact Us
                </h1>
                <div class="breadkcum">
                    <a href="{{ route('home') }}" class="link-breadkcum body-2 fw-7 split-text effect-right">Home</a>
                    <span class="dot"></span>
                    <span class="page-breadkcum body-2 fw-7 split-text effect-right"> Contact Us</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-title -->

    <!-- Main-content -->
    <div class="main-content">

        <section class="section-contact p-contact tf-spacing-2">
            <div class="tf-container">
                <div class="section-contact-inner flex justify-content-between flex-wrap">

                    <div class="left">
                        <div class="heading-section mb-30">
                            <div class="sub-title body-2 fw-7 mb-17 title-animation">
                                Get In Touch
                            </div>
                            <h2 class="title fw-6 mb-10 title-animation">
                                Let’s Talk For
                                <span class="fw-3">Next Projects</span>
                            </h2>
                        </div>
                        <div class="contact-list mb-30">
                            <div class="title body-2 fw-7 title-animation">Main Office</div>
                            <div class="contact-item location-item align-items-start title-animation">
                                <i class="icon-location-dot"></i>
                                <a href="#" class="lh-30">55 Main Street, San
                                    <br>Francisco, California. USA</a>
                            </div>
                            <div class="contact-item title-animation">
                                <i class="icon-email"></i>
                                <a href="#" class="lh-30">support@gmail.com</a>
                            </div>
                            <div class="contact-item title-animation">
                                <i class="icon-phone"></i>
                                <a href="#" class="lh-30">+1 (123) 456 889</a>
                            </div>
                        </div>
                        <div class="contact-social">
                            <div class="title body-2 fw-7 title-animation">Follow Me</div>
                            <ul class="post-social style-radius-50 style-bg-white g-10 title-animation">
                                <li><a href="#" class="icon-social"><i class="icon-fb"></i></a></li>
                                <li><a href="#" class="icon-social"><i class="icon-X"></i></a></li>
                                <li><a href="#" class="icon-social"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#" class="icon-social"><i class="icon-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="right">
                        <x-contact-form :dark="true" :categories="$navCategories" />
                    </div>

                </div>
            </div>
        </section>
        <div class="section-map">
            <div class="tf-container">
                <div class="wg-map tf-spacing-2">

                </div>
            </div>
        </div>

    </div>
    <!-- /.main-content -->
@endsection
