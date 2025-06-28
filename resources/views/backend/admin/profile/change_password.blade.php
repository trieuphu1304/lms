<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Đổi mật khẩu</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu mới</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
        </form>

    </div>
</div>
