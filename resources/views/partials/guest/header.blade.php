 <header class="header header-sticky" id="header">
     <div class="header-content flex justify-content-between align-items-center">
         <div class="header-left flex align-items-center">
             <div class="logo logo-header">
                 <a href="index.html">
                     <img src="image/logo/logo.svg" alt="">
                 </a>
             </div>
             <nav class="main-menu">
                 <ul class="menu-primary-menu">

                     <li class="menu-item {{ request()->routeIs('home') ? 'current-menu-item' : '' }}">
                         <a href="/" class="item-link body-2">
                             <span>Home</span>
                         </a>
                     </li>

                     <li class="menu-item {{ request()->routeIs('about') ? 'current-menu-item' : '' }}">
                         <a href="{{ route('about') }}" class="item-link body-2">
                             <span>About Us</span>
                         </a>
                     </li>

                     <li class="menu-item {{ request()->routeIs('services') ? 'current-menu-item' : '' }}">
                         <a href="{{ route('services') }}" class="item-link body-2">
                             <span>Services</span>
                         </a>
                     </li>

                     <li class="menu-item {{ request()->routeIs('blogs') ? 'current-menu-item' : '' }}">
                         <a href="{{ route('blogs') }}" class="item-link body-2">
                             <span>Blog</span>
                         </a>
                     </li>

                     <li class="menu-item {{ request()->routeIs('contact-us') ? 'current-menu-item' : '' }}">
                         <a href="{{ route('contact-us') }}" class="item-link body-2">
                             <span>Contact Us</span>
                         </a>
                     </li>

                 </ul>
             </nav>
         </div>
         <div class="header-right">
             <div class="nav-btn">
                 <a href="pricing.html" class="tf-btn">
                     <span>Get A Quote</span>
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
