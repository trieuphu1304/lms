<div class="content container-fluid">
    <div class="page-header">
        <h3 class="page-title">Thêm bài giảng</h3>
    </div>

    <form action="{{ route('teacher.lesson.store') }}" method="POST">
        @csrf
        <div class="card p-4">
            <div class="mb-3">
                <label class="form-label">Khóa học</label>
                <select name="course_id" class="form-select" required>
                    <option value="">-- Chọn khóa học --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Video URL</label>
                <input type="url" name="video_url" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tài liệu (Document URL)</label>
                <input type="url" name="document_url" class="form-control">
            </div>

            <div class="text-end">
                <a href="{{ route('teacher.lesson', $course->id) }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </form>
</div>
