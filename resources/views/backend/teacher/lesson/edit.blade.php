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

    <form action="{{ route('teacher.lesson.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-primary mb-4">
            <div class="card-header">Thông tin bài giảng</div>
            <div class="card-body">

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
                    <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="content" class="form-control" rows="4" required>{{ $lesson->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Video</label>
                    <input type="url" name="video_url" class="form-control" value="{{ $lesson->video_url }}"
                        id="video_url">
                    <small class="form-text text-muted">Nhập URL video hoặc tải lên tài liệu (chỉ được chọn 1 trong
                        2)</small>
                </div>

                <div class="form-group">
                    <label for="document_file">Tài liệu</label>
                    <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx"
                        id="document_file">
                    @if ($lesson->document_url)
                        <small class="form-text text-muted">Tài liệu hiện tại: <a
                                href="{{ asset($lesson->document_url) }}" target="_blank">Xem file</a></small><br>
                    @endif
                    <small class="form-text text-muted">Chọn file tài liệu hoặc nhập URL video (chỉ được chọn 1 trong
                        2)</small>
                </div>

                @if ($errors->has('media'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('media') }}
                    </div>
                @endif
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('teacher.lesson', $course->id) }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="bx bx-save"></i> Cập nhật
                </button>
            </div>
        </div>
    </form>

    <script>
        // Hàm hiển thị toast notification
        function showToast(message, type = 'warning') {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();
            const bgColor = type === 'error' ? 'bg-danger' : (type === 'success' ? 'bg-success' : 'bg-warning');

            const toastHTML = `
                <div id="${toastId}" class="toast show" role="alert">
                    <div class="toast-body ${bgColor} text-white">
                        <strong>${type === 'error' ? '❌ Lỗi' : type === 'success' ? '✅ Thành công' : '⚠️ Cảnh báo'}</strong>
                        <br>${message}
                    </div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHTML);

            // Tự động xóa sau 3 giây
            setTimeout(() => {
                const toast = document.getElementById(toastId);
                if (toast) {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 300);
                }
            }, 3000);
        }

        // Tạo container cho toast nếu chưa có
        if (!document.getElementById('toastContainer')) {
            const container = document.createElement('div');
            container.id = 'toastContainer';
            container.style.cssText =
                'position: fixed; top: 20px; right: 20px; z-index: 9999; width: 350px; max-width: 90vw;';
            document.body.appendChild(container);
        }

        document.getElementById('submitBtn').addEventListener('click', function(e) {
            const videoUrl = document.getElementById('video_url').value.trim();
            const documentFile = document.getElementById('document_file').files.length > 0;
            const existingDocument = '{{ !empty($lesson->document_url) }}' === '1' ||
                '{{ !empty($lesson->document_url) }}' === 'true';

            // Nếu không có video và không chọn file mới, kiểm tra xem có tài liệu cũ không
            if (!videoUrl && !documentFile && !existingDocument) {
                e.preventDefault();
                showToast('Vui lòng chọn video HOẶC tài liệu.', 'error');
                return false;
            }

            // Nếu có video và (có file mới hoặc có tài liệu cũ)
            if (videoUrl && (documentFile || existingDocument)) {
                e.preventDefault();
                showToast('Chỉ được chọn video HOẶC tài liệu, không được cả hai.', 'error');
                return false;
            }
        });

        // Xóa giá trị video khi chọn file tài liệu
        document.getElementById('document_file').addEventListener('change', function() {
            if (this.files.length > 0) {
                document.getElementById('video_url').value = '';
            }
        });

        // Xóa file tài liệu khi nhập video URL
        document.getElementById('video_url').addEventListener('input', function() {
            if (this.value.trim()) {
                document.getElementById('document_file').value = '';
            }
        });
    </script>
</div>
