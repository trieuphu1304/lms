<div class="content container-fluid">
    <div class="page-header mb-4">
        <h3 class="page-title text-primary fw-semibold">Chỉnh Sửa Chương Học</h3>
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

    <form action="{{ route('teacher.section.update', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-light-purple text-dark fw-semibold border-bottom">
                <i class="bx bx-layer me-1"></i> Thông tin chương học
            </div>

            <div class="card-body bg-white">
                <div class="mb-3">
                    <label class="form-label text-muted">Tên chương học</label>
                    <input type="text" name="title" class="form-control rounded-3"
                        value="{{ old('title', $section->title) }}" placeholder="VD: Giới thiệu khóa học,..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Khóa học</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Chọn khóa học --</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ old('course_id', $section->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer bg-light-purple text-end rounded-bottom-4">
                <a href="{{ route('teacher.section') }}" class="btn btn-outline-secondary me-2 rounded-3">
                    <i class="bx bx-arrow-back"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bx bx-save"></i> Cập nhật chương học
                </button>
            </div>
        </div>
    </form>
</div>
