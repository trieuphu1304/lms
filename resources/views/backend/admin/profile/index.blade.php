<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Thông tin cá nhân</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle"
                            width="150" height="150">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150" alt="Avatar"
                            class="rounded-circle">
                    @endif
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary mb-2">
                    <i class="bx bx-edit"></i> Chỉnh sửa thông tin
                </a>
                <a href="{{ route('admin.profile.password.change') }}" class="btn btn-warning mb-2">
                    <i class="bx bx-lock"></i> Đổi mật khẩu
                </a>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th>Họ tên:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo tài khoản:</th>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Quyền:</th>
                        <td>
                            @if (method_exists($user, 'getRoleNames'))
                                {{ implode(', ', $user->getRoleNames()->toArray()) }}
                            @else
                                {{ $user->role ?? '---' }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
