<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
  <base href="/public">
  <meta charset="utf-8" />

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LJK800KXFR"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LJK800KXFR');
</script>
  <title> Lonstack Solution - IT Company</title>
  <meta name="description"
    content="Teckko – Modern, responsive IT Company HTML Template perfect for showcasing IT services, digital solutions & boosting online sales effortlessly.">
  <meta name="keywords"
    content="it company template, it services template, technology website, software company website, digital solutions, responsive it template, it business, technology company, startup website, it solutions, modern it template, best it website, corporate it, it agency, website template for it">
  <meta name="author" content="themesflat.com" />

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
  <meta name="theme-color" content="#19272b">

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- Animate -->
  <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
  <!-- Magnific-popup -->
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.min.css" />
  <!-- Swiper -->
  <link rel="stylesheet" href="css/swiper-bundle.min.css">
  <!-- Nice select -->
  <link rel="stylesheet" href="css/nice-select.css">
  <!-- Odometer -->
  <link rel="stylesheet" href="css/odometer-theme-default.css">
  <!-- Textanimation -->
  <link rel="stylesheet" href="css/textanimation.css">

  <!-- Theme Style -->
  <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />

  <!-- Tabler Icon CSS -->
  <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/tabler-icons/tabler-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard_assets/css/feather.css') }}">
  <link rel="stylesheet" type="text/css" href="css/custom.css" />

  <!-- Icon -->
  <link rel="stylesheet" type="text/css" href="icons/icomoon/style.css" />

  <!-- Favicon and Touch Icons  -->
  <link rel="shortcut icon" href="image/logo/favicon.png" />
  <link rel="apple-touch-icon-precomposed" href="image/logo/favicon.png" />

  @stack('styles')
</head>

<body class="counter-scroll @yield('body-class')">

  <!-- .preload -->
  <div id="loading">
    <div id="loading-center">
      <div class="loader-container">
        <div class="wrap-loader">
          <div class="loader">
          </div>
          <div class="icon">
            <img src="{{ asset('image/logo/favicon.png') }}" alt="logo">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.preload -->
  <div class="wrapper position-relative">

    <!-- Top-bar -->
    @include('partials.guest.topbar')
    <!-- /.top-bar -->

    <!-- Header -->
    @include('partials.guest.header')
    <!-- /.header -->




    <!-- Main-content -->
    @yield('content')
    <!-- /.main-content -->

    @include('partials.guest.footer')


    <!-- Mobile-nav-wrap -->
    @include('partials.guest.mobile-nav')
    <!-- /.mobile-nav-wrap -->

    <!-- OffcanvasMegamenu -->
    @include('partials.guest.offcanvasmegamenu')
    <!-- /.offcanvasMegamenu -->

    <!-- Go-top -->
    <div class="progress-wrap">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
          style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 277.672;">
        </path>
      </svg>
    </div>
    <!-- /.go-top -->

    <div class="overlay-filter" id="overlay-filter"></div>

  </div>

  <!-- Javascript -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/lazysize.min.js"></script>
  <script src="js/magnific-popup.min.js"></script>
  <script src="js/gsap.min.js"></script>
  <script src="js/gsap-animation.js"></script>
  <script src="js/ScrollTrigger.min.js"></script>
  <script src="js/Splitetext.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/ScrollSmooth.js"></script>
  <script src="js/swiper-bundle.min.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/odometer.min.js"></script>
  <script src="js/jquery-validate.js"></script>
  <script src="js/textanimation.js"></script>
  <!-- Feather Icon JS -->
  <script src="{{asset('dashboard_assets/js/feather.min.js')}}" type="bba39571e659c7cea8b06dff-text/javascript"></script>


  <script type="text/javascript" src="js/main.js"></script>
  <script src="js/sibforms.js" defer></script>
  <script>
    window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
    window.LOCALE = 'en';
    window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE =
      "The information provided is invalid. Please review the field format and try again.";

    window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

    window.GENERIC_INVALID_MESSAGE =
      "The information provided is invalid. Please review the field format and try again.";

    window.translation = {
      common: {
        selectedList: '{quantity} list selected',
        selectedLists: '{quantity} lists selected'
      }
    };

    var AUTOHIDE = Boolean(0);
  </script>

  <!-- /Javascript -->

  @stack('scripts')

</body>

</html>