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
            <a href="{{ route('teacher.quiz.create', $lesson->id) }}" class="btn btn-primary">
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
                <th>Tiêu đề</th>
                <th>Thao tác</th>
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
</div>
