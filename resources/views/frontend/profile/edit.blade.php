<div class="container py-5">
    <h2 class="mb-4">Chỉnh sửa thông tin cá nhân</h2>

    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Ảnh đại diện (tùy chọn)</label>
            <input type="file" name="avatar" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>

</div>
