<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo active">
        <a href="/" class="logo logo-normal" style="width: 80px">
            <img src="{{ asset('image/logo/logo-black.png') }}" alt="main">
        </a>
        <a href="/" class="logo logo-white">
            <img src="{{ asset('image/logo/logo-black.png') }}" alt="main2">
        </a>
        <a href="/" class="logo-small">
            <img src="{{ asset('image/logo/logo-black.png') }}" alt="main3">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>

    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <!-- MAIN -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="ti ti-layout-grid fs-16 me-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- USER MANAGEMENT -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-users fs-16 me-2"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- CONTENT (CMS)  -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Content (CMS)</h6>
                    <ul>

                        <li class="submenu mb-1">
                            <a href="javascript:void(0);">
                                <i class="ti ti-article fs-16 me-2"></i>
                                <span>Blog</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="javascript:void(0)">All Posts</a></li>
                                <li><a href="javascript:void(0)">Categories</a></li>
                            </ul>
                        </li>

                        <li class="mb-1">
                            <a href="javascript:void(0)">
                                <i class="ti ti-briefcase fs-16 me-2"></i>
                                <span>Portfolio</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-quote fs-16 me-2"></i>
                                <span>Testimonials</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-help-circle fs-16 me-2"></i>
                                <span>FAQ</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-news fs-16 me-2"></i>
                                <span>Press / Media</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-id-badge fs-16 me-2"></i>
                                <span>Career / Jobs</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-trophy fs-16 me-2"></i>
                                <span>Awards</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-mail-opened fs-16 me-2"></i>
                                <span>Enquiries</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- WEBSITE PAGES -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Website Pages</h6>
                    <ul>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-home fs-16 me-2"></i>
                                <span>Home Page</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-building fs-16 me-2"></i>
                                <span>About Page</span>
                            </a>
                        </li>

                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-stack fs-16 me-2"></i>
                                <span>Services</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="javascript:void(0)">All Services</a></li>
                                <li><a href="javascript:void(0)">Categories</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-phone fs-16 me-2"></i>
                                <span>Contact Page</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- SYSTEM SETTINGS -->
                <li class="submenu-open">
                    <h6 class="submenu-hdr">System Settings</h6>
                    <ul>

                        <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }} mb-1">
                            <a href="{{ route('admin.settings.index') }}">
                                <i class="ti ti-settings fs-16 me-2"></i>
                                <span>General Settings</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }} mb-1">
                            <a href="{{ route('admin.profile.index') }}">
                                <i class="ti ti-user-circle fs-16 me-2"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>

                        <li>
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
