<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <!-- Tombol Hamburger (HANYA MUNCUL DI MOBILE / d-lg-none) -->
            <button type="button" id="btnMobileMenu" class="btn btn-toggle d-inline-flex d-lg-none me-2 p-0 border-0 bg-transparent" aria-label="Toggle Navigation">
                <img src="{{ asset('assets/img/menu.png') }}" alt="Menu" height="22">
            </button>

            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_dark.svg') }}" alt="navbar brand" class="navbar-brand" height="25">
            </a>

        </div>
        <!-- End Logo Header -->
    </div>

    <!-- Navbar Header (Hidden di Mobile, Muncul di Desktop) -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg d-none d-lg-flex">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset('assets/img/profile.jpg') }}" alt="profile" class="avatar-img rounded-circle">
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Halo,</span> <span class="fw-bold">{{ Auth::user()->nama }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded">
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->nama }}</h4>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
