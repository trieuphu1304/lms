<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">
            Danh sách bài kiểm tra của bài
            <span class="text-secondary fw-semibold">{{ $lesson->title }}</span>
        </h3>



        <div class="d-flex gap-2">
            <a href="{{ route('teacher.lesson', $lesson->course_id) }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Quay lại bài giảng
            </a>
            <a href="{{ route('teacher.quiz.create', $lesson->id) }}" class="btn btn-primary" id="addQuizBtn">
                <i class="bx bx-plus"></i> Thêm bài kiểm tra
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Tên bài kiểm tra</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $quiz->title }}</td>
                    <td>
                        <a href="{{ route('teacher.question', ['quiz' => $quiz->id]) }}"
                            class="btn btn-sm btn-outline-success">
                            Xem câu hỏi
                        </a>
                        <a href="{{ route('teacher.quiz.edit', $quiz->id) }}"
                            class="btn btn-sm btn-outline-warning">Sửa</a>
                        <form action="{{ route('teacher.quiz.delete', $quiz->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn chắc là muốn xóa?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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

        // Kiểm tra nếu đã có 1 quiz thì không cho thêm mới
        document.getElementById('addQuizBtn').addEventListener('click', function(e) {
            const quizCount = document.querySelectorAll('tbody tr').length;

            if (quizCount >= 1) {
                e.preventDefault();
                showToast('Mỗi bài giảng chỉ được có 1 bài kiểm tra.', 'error');
                return false;
            }
        });
    </script>
</div>
