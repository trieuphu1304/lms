<div class="content container-fluid">
    <div class="page-header mb-4">
        <h3 class="page-title text-primary fw-semibold">Thêm Khóa Học Mới</h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-warning border-start border-warning border-3 rounded">
            <strong>Lỗi!</strong> Vui lòng kiểm tra lại thông tin.
            <ul class="mt-2 mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.course.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-light-purple text-dark fw-semibold border-bottom">
                <i class="bx bx-book me-1"></i> Thông tin khóa học
            </div>

            <div class="card-body bg-white">

                <div class="mb-3">
                    <label class="form-label text-muted">Tên khóa học</label>
                    <input type="text" name="title" class="form-control rounded-3"
                        placeholder="VD: Lập trình PHP cơ bản" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Danh mục</label>
                    <select name="category_id" class="form-select rounded-3" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Mô tả</label>
                    <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Mô tả chi tiết khóa học"
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Trình độ</label>
                    <select name="level" class="form-select rounded-3" required>
                        <option value="">-- Chọn trình độ --</option>
                        <option value="Cơ bản">Cơ bản</option>
                        <option value="Trung bình">Trung bình</option>
                        <option value="Nâng cao">Nâng cao</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Ảnh đại diện khóa học</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*">
                    @if (isset($course) && $course->avatar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $course->avatar) }}" alt="avatar"
                                style="max-width:100px;">
                        </div>
                    @endif
                </div>

            </div>

            <div class="card-footer bg-light-purple text-end rounded-bottom-4">
                <a href="{{ route('teacher.course') }}" class="btn btn-outline-secondary me-2 rounded-3">
                    <i class="bx bx-arrow-back"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bx bx-save"></i> Lưu
                </button>
            </div>
        </div>
    </form>
</div>
