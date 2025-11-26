<div class="content container-fluid">
    <div class="page-header">
        <h3 class="page-title">Thêm bài giảng</h3>
    </div>

    <form action="{{ route('teacher.lesson.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card p-4">
            <!-- Khóa học (khóa để không cho chọn lại) -->
            <div class="mb-3">
                <label class="form-label">Khóa học</label>
                <input type="text" class="form-control" value="{{ $course->title }}" disabled>
                <input type="hidden" name="course_id" value="{{ $course->id }}">
            </div>

            <!-- Section chỉ hiển thị theo course đó -->
            <div class="mb-3">
                <label class="form-label">Chương học</label>
                <select name="section_id" class="form-select" required>
                    <option value="">-- Chọn chương học --</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên bài giảng</label>
                <input type="text" name="title" class="form-control" required>
            </div>


            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="content" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Video bài giảng</label>
                <input type="url" name="video_url" class="form-control">
            </div>

            <div class="form-group">
                <label for="document_file">Tài liệu</label>
                <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx">
            </div>

            <div class="text-end">
                <a href="{{ route('teacher.lesson', $course->id) }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </form>
</div>
