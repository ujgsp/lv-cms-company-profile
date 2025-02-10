<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            {{-- <li class="nav-item">
                <div style="padding: 6px 15px; margin: 0;" class="alert alert-danger">
                    <span>Certain Features are disabled in Demo Mode.</span>
                </div>
            </li> --}}


            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <?php
                    // Mendapatkan warna latar belakang berdasarkan nama pengguna
                    $name = Auth::user()->name;
                    $background_color = '#' . substr(md5($name), 0, 6);
                    $avatar_url = "https://ui-avatars.com/api/?name=" . urlencode($name) .
                        "&size=100&rounded=true&color=fff&background=" . urlencode($background_color)
                    ?>
                    <img src="<?= $avatar_url ?>" class="avatar img-fluid rounded me-1" alt="{{ $name }}" />
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="align-middle me-1" data-feather="user"></i>
                        Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" target="_blank" href="{{ route('frontend.index') }}"><i
                            class="align-middle me-1" data-feather="external-link"></i>
                        Visit Website</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
