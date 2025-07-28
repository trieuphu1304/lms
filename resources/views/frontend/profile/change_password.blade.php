<div class="container py-5">
    <h3>Đổi mật khẩu</h3>

    <form method="POST" action="{{ route('student.update_password') }}">
        @csrf

        <div class="form-group">
            <label>Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="form-control" required>
            @error('current_password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" required>
            @error('new_password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Nhập lại mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
    </form>

</div>
