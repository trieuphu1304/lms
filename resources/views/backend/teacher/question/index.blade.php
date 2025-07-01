<div class="content container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">
            Danh sách câu hỏi của bài kiểm tra
            <span class="text-secondary fw-semibold">{{ $quiz->title }}</span>
        </h3>



        <div class="d-flex gap-2">
            <a href="{{ route('teacher.lesson.quizzes', ['lesson' => $quiz->lesson_id]) }}"
                class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Quay lại bài kiểm tra
            </a>

            <a href="{{ route('teacher.question.create', $quiz->id) }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm câu hỏi
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-primary shadow">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Câu hỏi</th>
                        <th>Đáp án đúng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questions as $question)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->correct_option }}</td>
                            <td>
                                <a href="{{ route('teacher.quiz_results.by_quiz', $quiz->id) }}"
                                    class="btn btn-sm btn-outline-success">
                                    <i class="bx bx-edit"></i> Xem điểm học viên
                                </a>
                                <a href="{{ route('teacher.question.edit', $question->id) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    <i class="bx bx-edit"></i> Sửa
                                </a>
                                <form action="{{ route('teacher.question.delete', $question->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Chưa có câu hỏi nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
