<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>

            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">
                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i></a>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            data-bs-toggle="dropdown">
                            <span class="alert-count">{{ isset($adminUnreadCount) ? $adminUnreadCount : 0 }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Học viên đăng ký mới</p>
                                    <p class="msg-header-badge">
                                        {{ isset($adminUnreadCount) ? $adminUnreadCount : 0 }} New</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @if (isset($adminNotifications) && $adminNotifications->count())
                                    @foreach ($adminNotifications as $noti)
                                        <a class="dropdown-item notification-item"
                                            href="{{ url('admin/students/' . $noti->actor_id) }}"
                                            data-id="{{ $noti->id }}">
                                            <div class="d-flex align-items-center">
                                                <div class="user-online">
                                                    <img src="{{ $noti->actor && $noti->actor->avatar ? asset('storage/' . $noti->actor->avatar) : asset('backend/assets/images/avatars/avatar-1.png') }}"
                                                        class="msg-avatar" alt="user avatar">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">{{ $noti->actor_name }} <span
                                                            class="msg-time float-end">{{ $noti->created_at->diffForHumans() }}</span>
                                                    </h6>
                                                    <p class="msg-info">{{ $noti->title }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="text-center text-muted p-3">Không có thông báo mới</div>
                                @endif
                            </div>
                            <div class="d-flex gap-2 p-2">
                                <button id="markReadBtn" class="btn btn-sm btn-success w-100">Đã đọc</button>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="{{ asset('storage/' . $currentUser->avatar) }}" class="user-img" alt="user avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">
                            {{ auth()->user()->name }}
                        </p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}"><i
                                class="bx bx-user fs-5"></i><span>Thông tin</span></a></li>
                    <li><a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.profile.password.change') }}"><i class="bx bx-cog fs-5"></i><span>Cài
                                đặt mật khẩu</span></a></li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>

                        <a class="dropdown-item d-flex align-items-center" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle"></i><span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const markBtn = document.getElementById('markReadBtn');

        function collectNotificationIds() {
            const items = Array.from(document.querySelectorAll('.notification-item'));
            return items.map(i => parseInt(i.dataset.id));
        }

        if (markBtn) {
            markBtn.addEventListener('click', function() {
                const ids = collectNotificationIds();
                if (ids.length === 0) return;

                fetch("{{ url('/admin/notifications/mark-read') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        ids: ids
                    })
                }).then(r => r.json()).then(res => {
                    // remove items from dropdown
                    document.querySelectorAll('.notification-item').forEach(n => n.remove());

                    // update badge counts
                    const alertEl = document.querySelector('.alert-count');
                    const headerBadge = document.querySelector('.msg-header-badge');
                    if (alertEl) alertEl.textContent = res.unread || 0;
                    if (headerBadge) headerBadge.textContent = (res.unread || 0) + ' New';
                });
            });
        }
    });
</script>
