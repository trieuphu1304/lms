<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Danh sách câu hỏi - {{ $quiz->title }}</h2>
        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('admin.quiz_result.detail', $results->id) }}" class="btn btn-info">
                <i class="bx bx-bar-chart"></i> Xem điểm học viên
            </a>
        </div>
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nội dung câu hỏi</th>
                <th>Đáp án đúng</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $index => $question)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td>{{ $question->correct_option }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.question.delete', $question->id) }}" method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('Bạn có chắc muốn xóa câu hỏi này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        <a href="{{ route('admin.quiz') }}" class="btn btn-secondary mt-3">
            <i class="bx bx-arrow-back"></i> Quay lại danh sách bài kiểm tra
        </a>
    </div>
</div>
