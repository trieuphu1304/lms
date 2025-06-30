<div class="content container-fluid">
    <div class="page-header">
        <h3 class="page-title">Chỉnh sửa Bài Giảng</h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.lesson.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card border-primary mb-4">
            <div class="card-header">Thông tin bài giảng</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control" rows="4" required>{{ $lesson->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Video</label>
                    <input type="url" name="video_url" class="form-control" value="{{ $lesson->video_url }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Tài liệu</label>
                    <input type="url" name="document_url" class="form-control" value="{{ $lesson->document_url }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Khóa học</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Chọn khóa học --</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('teacher.lesson') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Cập nhật
                </button>
            </div>
        </div>
    </form>
</div>
