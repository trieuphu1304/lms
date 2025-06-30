<div class="content container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">Thêm câu hỏi mới</h3>
        <a href="{{ route('teacher.question', $quiz->id) }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Quay lại
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-primary shadow">
        <div class="card-body">
            <form action="{{ route('teacher.question.store') }}" method="POST">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                <div class="mb-3">
                    <label for="question_text" class="form-label">Câu hỏi</label>
                    <input type="text" name="question_text" class="form-control" required>
                </div>

                @foreach (['A', 'B', 'C', 'D'] as $opt)
                    <div class="mb-3">
                        <label class="form-label">Đáp án {{ $opt }}</label>
                        <input type="text" name="option_{{ strtolower($opt) }}" class="form-control" required>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label for="correct_option" class="form-label">Đáp án đúng</label>
                    <select name="correct_option" class="form-select" required>
                        <option value="">-- Chọn --</option>
                        @foreach (['A', 'B', 'C', 'D'] as $opt)
                            <option value="{{ $opt }}">{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Lưu câu hỏi
                </button>
            </form>
        </div>
    </div>
</div>
