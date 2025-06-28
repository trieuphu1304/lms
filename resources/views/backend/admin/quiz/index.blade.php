<div class="page-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách bài kiểm tra</h2>
        </div>
        <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tên bài kiểm tra</th>
                    <th>Bài giảng</th>
                    <th>Khóa học</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $index => $quiz)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->lesson->title ?? '---' }}</td>
                        <td>{{ $quiz->lesson->course->title ?? '---' }}</td>
                        <td>{{ $quiz->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.quiz.show', $quiz->id) }}" class="btn btn-sm btn-info me-1">
                                <i class="bx bx-show"></i> Xem
                            </a>
                            <form action="{{ route('admin.quiz.delete', $quiz->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Bạn có chắc muốn xóa bài kiểm tra này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
