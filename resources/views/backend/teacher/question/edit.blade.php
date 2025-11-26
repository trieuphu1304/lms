<div class="content container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">Chỉnh sửa câu hỏi</h3>

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
            <form action="{{ route('teacher.question.update', $question->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Câu hỏi</label>
                    <input type="text" name="question_text"
                        value="{{ old('question_text', $question->question_text) }}" class="form-control" required>
                </div>

                @foreach (['A', 'B', 'C', 'D'] as $opt)
                    <div class="mb-3">
                        <label class="form-label">Đáp án {{ $opt }}</label>
                        <input type="text" name="option_{{ strtolower($opt) }}"
                            value="{{ old('option_' . strtolower($opt), $question['option_' . strtolower($opt)]) }}"
                            class="form-control" required>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label class="form-label">Đáp án đúng</label>
                    <select name="correct_option" class="form-select" required>
                        @foreach (['A', 'B', 'C', 'D'] as $opt)
                            <option value="{{ $opt }}"
                                {{ $question->correct_option === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-end">
                    <a href="{{ route('teacher.question', $question->quiz_id) }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
