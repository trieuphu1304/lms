<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-success text-white d-flex align-items-center">
                <i class="bx bx-book-add fs-4 me-2"></i>
                <h4 class="mb-0">Thêm khóa học mới</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-book"></i> Tên khóa học</label>
                        <input type="text" name="title" class="form-control" placeholder="Nhập tên khóa học" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-detail"></i> Mô tả</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Nhập mô tả" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-layer"></i> Cấp độ</label>
                        <select name="level" class="form-select" required>
                            <option value="">-- Chọn cấp độ --</option>
                            <option value="beginner" class="text-success">Cơ bản</option>
                            <option value="intermediate" class="text-info">Trung bình</option>
                            <option value="advanced" class="text-warning">Nâng cao</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-user"></i> Giáo viên</label>
                        <select name="teacher_id" class="form-select" required>
                            <option value="">-- Chọn giáo viên --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.course') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bx bx-save"></i> Lưu khóa học
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>