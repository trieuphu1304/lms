<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary">Chỉnh sửa bài kiểm tra</h3>
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

            <form action="{{ route('teacher.quiz.update', $quiz->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="lesson_id" class="form-label">Bài giảng</label>
                    <select name="lesson_id" id="lesson_id" class="form-select" disabled>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ $lesson->id == $quiz->lesson_id ? 'selected' : '' }}>
                                {{ $lesson->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Không thể thay đổi bài giảng đã gán.</div>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}"
                        class="form-control" required>
                </div>
                <div class="text-end">
                    <a href="{{ route('teacher.lesson.quizzes', $quiz->lesson_id) }}" class="btn btn-outline-secondary">
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
