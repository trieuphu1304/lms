<div class="header">

    <div class="header-left">
        <a href="{{ url('teacher/dashboard') }}" class="logo">
            <img src="{{ asset('backend/teacher/assets/img/logo.png') }}" alt="Logo">
        </a>
        <a href="{{ url('teacher/dashboard') }}" class="logo logo-small">
            <img src="{{ asset('backend/teacher/assets/img/logo-small.png') }}" alt="Logo" width="30"
                height="30">
        </a>
    </div>

    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>
    </div>



    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item dropdown noti-dropdown me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="{{ asset('backend/teacher/assets/img/icons/header-icon-05.svg') }}" alt>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Thông báo</span>
                    <a href="javascript:void(0)" class="clear-noti">Xóa tất cả</a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @foreach ([['avatar' => 'avatar-02.jpg', 'name' => 'Carlson Tech', 'content' => 'has approved your estimate', 'time' => '4 mins ago'], ['avatar' => 'avatar-11.jpg', 'name' => 'International Software Inc', 'content' => 'has sent you a invoice in the amount of $218', 'time' => '6 mins ago'], ['avatar' => 'avatar-17.jpg', 'name' => 'John Hendry', 'content' => 'sent a cancellation request Apple iPhone XR', 'time' => '8 mins ago'], ['avatar' => 'avatar-13.jpg', 'name' => 'Mercury Software Inc', 'content' => 'added a new product Apple MacBook Pro', 'time' => '12 mins ago']] as $noti)
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media d-flex">
                                        <span class="avatar avatar-sm flex-shrink-0">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('backend/teacher/assets/img/profiles/' . $noti['avatar']) }}">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">{{ $noti['name'] }}</span>
                                                {{ $noti['content'] }}</p>
                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $noti['time'] }}</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">Xem tất cả</a>
                </div>
            </div>
        </li>

        <li class="nav-item zoom-screen me-2">
            <a href="#" class="nav-link header-nav-list">
                <img src="{{ asset('backend/teacher/assets/img/icons/header-icon-04.svg') }}" alt>
            </a>
        </li>

        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ asset('backend/teacher/assets/img/profiles/avatar-01.jpg') }}"
                        width="31" alt="Soeng Souy">
                    <div class="user-text">
                        <h6>Soeng Souy</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ asset('backend/teacher/assets/img/profiles/avatar-01.jpg') }}" alt="User Image"
                            class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>Ryan Taylor</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ url('teacher/profile') }}">Thông tin</a>
                <a class="dropdown-item" href="{{ url('logout') }}">Đăng xuất</a>
            </div>
        </li>
    </ul>
</div>
