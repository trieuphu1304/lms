<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary">Tạo bài kiểm tra mới</h3>
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

            <form action="{{ route('teacher.quiz.store') }}" method="POST">
                @csrf

                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

                <div class="mb-3">
                    <label class="form-label">Bài giảng</label>
                    <input type="text" class="form-control" value="{{ $lesson->title }}" disabled>
                    <div class="form-text">Bài kiểm tra sẽ thuộc bài giảng này.</div>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề bài kiểm tra</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                        required>
                </div>

                <div class="text-end">
                    <a href="{{ route('teacher.lesson.quizzes', $lesson->id) }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Tạo mới
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
