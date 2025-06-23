<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="bx bx-user-plus fs-4 me-2"></i>
                <h4 class="mb-0">Thêm tài khoản mới</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.account.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-user"></i> Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-lock"></i> Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-shield"></i> Vai trò</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Chọn vai trò --</option>
                            <option value="admin" class="text-danger">Quản trị viên</option>
                            <option value="teacher" class="text-info">Giáo viên</option>
                            <option value="student" class="text-success">Học sinh</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.account') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bx bx-save"></i> Lưu tài khoản
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>