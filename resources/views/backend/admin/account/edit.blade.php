<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-warning text-white d-flex align-items-center">
                <i class="bx bx-edit fs-4 me-2"></i>
                <h4 class="mb-0">Chỉnh sửa tài khoản</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.account.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-user"></i> Tên</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-lock"></i> Mật khẩu mới (bỏ trống nếu không đổi)</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-shield"></i> Vai trò</label>
                        <select name="role" class="form-select" required>
                            <option value="admin" @if($user->role == 'admin') selected @endif class="text-danger">Quản trị viên</option>
                            <option value="teacher" @if($user->role == 'teacher') selected @endif class="text-info">Giáo viên</option>
                            <option value="student" @if($user->role == 'student') selected @endif class="text-success">Học sinh</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.account') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bx bx-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>