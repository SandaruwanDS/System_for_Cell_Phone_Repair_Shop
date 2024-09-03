<div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
<div class="header header-one">
    <div class="header-left header-left-one">
        <a href="index.html" class="logo">
            <img src="https://toyto.lk/wp-content/uploads/2021/05/Toyto-MobileShop.png" alt="Logo">
        </a>
        {{-- <p>AccesBook-smartOmega</p> --}}
    </div>
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-bars"></i>
    </a>
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <ul class="nav nav-tabs user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <img src="assets/img/profiles/avatar-01.jpg" alt="">
                    <span class="status online"></span>
                </span>
                <span>{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.html"><i data-feather="user" class="me-1"></i>
                    Profile</a>
                {{-- <a class="dropdown-item" href="settings.html"><i data-feather="settings" class="me-1"></i>
                    Settings</a> --}}

                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
                {{-- <a class="dropdown-item" href="login.html"><i data-feather="log-out" class="me-1"></i>
                    Logout</a> --}}

            </div>
        </li>
    </ul>
</div>
</div>
