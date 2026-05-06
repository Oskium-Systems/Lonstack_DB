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
                        <form id="contactform" class="form-contact-us style-bg-dark-2 px-md-15" method="post"
                            action="./contact/contact-process.php">
                            <div class="cols mb-37 g-30">
                                <fieldset class="item">
                                    <label for="name" class="sub-title body-2 fw-5">Full Name</label>
                                    <fieldset class="position-relative">
                                        <i class="icon-user"></i>
                                        <input type="text" name="name" id="name" placeholder="Name"
                                            value="Richard D. Hammond" required>
                                    </fieldset>
                                </fieldset>

                                <fieldset class="item">
                                    <label for="mail" class="sub-title body-2 fw-5">Email Address</label>
                                    <fieldset class="position-relative">
                                        <i class="icon-email"></i>
                                        <input type="email" name="mail" id="mail" placeholder="Email"
                                            value="support@gmail.com" required>
                                    </fieldset>
                                </fieldset>
                            </div>
                            <div class="cols mb-37 g-30">
                                <fieldset class="item">
                                    <label for="phone" class="sub-title body-2 fw-5">Phone Number</label>
                                    <fieldset class="position-relative">
                                        <i class="icon-phone"></i>
                                        <input type="number" name="phone" id="phone" placeholder="+1 (123) 456 889"
                                            value="" required>
                                    </fieldset>
                                </fieldset>

                                <fieldset class="item">
                                    <div class="sub-title body-2 fw-5">
                                        Subject
                                    </div>
                                    <div class="nice-select">
                                        <span class="current caption-1">I would like to discussed</span>
                                        <ul class="list">
                                            <li class="option option-all selected focus">
                                                I would like to discussed
                                            </li>
                                            <li class="option">
                                                Machine Learning
                                            </li>
                                            <li class="option">
                                                Artificial Intelligence
                                            </li>
                                            <li class="option">
                                                Augmented Reality
                                            </li>
                                            <li class="option">
                                                Software Development
                                            </li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>

                            <fieldset class="mb-40">
                                <label for="message" class="sub-title body-2 fw-5">Message</label>
                                <textarea name="message" id="message" placeholder="Write message" required></textarea>
                            </fieldset>

                            <button type="submit" class="tf-btn">
                                <span>Send Us Message</span>
                                <i class="icon-arrow-right"></i>
                            </button>

                        </form>
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
