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
                    <form method="POST" action="{{ route('teacher.notifications.delete_all') }}"
                        id="clearAllNotificationsForm" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <a href="javascript:void(0);" class="clear-noti"
                            onclick="document.getElementById('clearAllNotificationsForm').submit();">
                            Xóa tất cả
                        </a>
                    </form>

                </div>

                <div class="noti-content">
                    <ul class="notification-list">
                        @forelse ($notifications as $noti)
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media d-flex">
                                        <span class="avatar avatar-sm flex-shrink-0">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('storage/' . ($noti->user->avatar ?? 'default.jpg')) }}">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title">{{ $noti->user->name ?? 'Người dùng' }}</span>
                                                {{ $noti->title }}
                                            </p>
                                            <p class="noti-time">
                                                <span
                                                    class="notification-time">{{ $noti->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="notification-message text-center text-muted">
                                Không có thông báo nào.
                            </li>
                        @endforelse
                    </ul>
                </div>

                <div class="topnav-dropdown-footer">
                    <a href="#"></a>
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
                    <img src="{{ asset('storage/' . $currentUser->avatar) }}" class="rounded-circle" width="31"
                        alt="Soeng Souy">

                    <div class="user-text">
                        <h6>{{ auth()->user()->name }}</h6>
                        <p class="text-muted mb-0"></p>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ asset('storage/' . $currentUser->avatar) }}" class="avatar-img rounded-circle"
                            alt="User Image">

                    </div>
                    <div class="user-text">
                        <h6>{{ auth()->user()->name }}</h6>
                        <p class="text-muted mb-0">
                            {{ auth()->user()->role }}
                        </p>

                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('teacher.profile') }}">Thông tin</a>
                <form action="{{ route('teacher.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item bg-transparent border-0 text-start w-100">
                        <i class="bx bx-log-out"></i> Đăng xuất
                    </button>
                </form>

            </div>
        </li>
    </ul>
</div>
