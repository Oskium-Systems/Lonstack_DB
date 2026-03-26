<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo active">
        <a href="/" class="logo logo-normal" style="width: 80px">
            <img src="assets/imgs/logo/logo-black.svg" alt="main">
        </a>
        <a href="/" class="logo logo-white">
            <img src="assets/imgs/logo/logo-white.svg" alt="main2">
        </a>
        <a href="/" class="logo-small">
            <img src="assets/imgs/logo/logo-white.svg" alt="main3">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="">
                                <i class="ti ti-layout-grid fs-16 me-2">
                                </i><span>Dashboard</span>
                            </a>
                        </li>


                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-layout-sidebar-right-collapse fs-16 me-2"></i><span>Layouts</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="layout-horizontal.html">Horizontal</a></li>
                                <li><a href="layout-detached.html">Detached</a></li>
                                <li><a href="layout-two-column.html">Two Column</a></li>
                                <li><a href="layout-hovered.html">Hovered</a></li>
                                <li><a href="layout-boxed.html">Boxed</a></li>
                                <li><a href="layout-rtl.html">RTL</a></li>
                                <li><a href="layout-dark.html">Dark</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                   <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li class="mb-1 ">
                            <a href="">
                                <i class="ti ti-key fs-16 me-2"></i>
                                <span>Registration Tokens</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Content (CMS)</h6>
                    <ul>

                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-wallpaper fs-16 me-2"></i><span>Blog</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="">Categories</a></li>
                                <li><a href="">All Blog</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="">
                                <i class="ti ti-star fs-16 me-2"></i>
                                <span>Testimonials</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="ti ti-help-circle fs-16 me-2"></i>
                                <span>FAQ</span>
                            </a>
                        </li>

                    </ul>
                </li>





                <li class="submenu-open">
                    <h6 class="submenu-hdr">System Settings</h6>
                    <ul>
                        <li class="mb-1 ">
                            <a href="">
                                <i class="ti ti-settings fs-16 me-2"></i>
                                <span>General Settings</span>
                            </a>
                        </li>



                        <li class="mb-1 ">
                            <a href="">
                                <i class="ti ti-user-circle fs-16 me-2"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>

                        <li class="mb-1">
                            <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();">
                                <i class="ti ti-logout fs-16 me-2"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
