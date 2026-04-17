@extends('layouts.guest')

@section('content')
        <!-- Page-title -->
        <div class="page-title">
            <div class="tf-container">
                <div class="page-title-content text-center">
                    <h1 class="title split-text effect-right">
                        Porfolio
                    </h1>
                </div>
            </div>
        </div>
        <!-- /.page-title -->

        <!-- Main-content -->
        <div class="main-content tf-spacing-2">
            <div class="tf-container">
                <div class="flat-animate-tab mb-70">
                    <div class="wg-tab style-2">
                        <ul class="tab-product" role="tablist">
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab1" data-bs-toggle="tab" role="tab" class="active fw-5 body-2">Show All</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab2" data-bs-toggle="tab" role="tab" class="fw-5 body-2">Design</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab3" data-bs-toggle="tab" role="tab" class="fw-5 body-2">Branding</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab4" data-bs-toggle="tab" role="tab" class="fw-5 body-2">Marketing</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab5" data-bs-toggle="tab" role="tab" class="fw-5 body-2">Development</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab6" data-bs-toggle="tab" role="tab" class="fw-5 body-2">Mobile Apps</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#tab7" data-bs-toggle="tab" role="tab" class="fw-5 body-2">Graphics</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flat-animate-tab">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab1" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab2" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab3" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab4" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab5" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab6" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab7" role="tabpanel">
                        <div class="tf-container">
                            <div class="row rg-70">

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-2.jpg" data-src="image/project-item/project-item-2.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Mobile Application Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-3.jpg" data-src="image/project-item/project-item-3.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">UI/UX Design</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-4.jpg" data-src="image/project-item/project-item-4.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">UI/UX Design</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Contemporary Art</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-5.jpg" data-src="image/project-item/project-item-5.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Software Development</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">App For Rent A Car</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-6.jpg" data-src="image/project-item/project-item-6.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Business</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Business Analysis</a></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="project-gird-item project-item">
                                        <a href="{{ route('portfolio-details') }}" class="image">
                                            <img src="image/project-item/project-item-7.jpg" data-src="image/project-item/project-item-7.jpg" alt="" class="lazyload">
                                        </a>
                                        <div class="item-content">
                                            <div class="sub-title body-2 fw-7">Technology</div>
                                            <h3 class="title-project"><a href="{{ route('portfolio-details') }}">Data Recovery</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.main-content -->
@endsection
