<div class="page-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"> Tất cả kết quả bài kiểm tra</h2>
        </div>
        <form method="GET" action="{{ route('admin.quiz_result.all') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="text" name="student" class="form-control" placeholder="Tìm theo tên học viên"
                    value="{{ request('student') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="quiz" class="form-control" placeholder="Tìm theo tên bài kiểm tra"
                    value="{{ request('quiz') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="course" class="form-control" placeholder="Tìm theo tên khóa học"
                    value="{{ request('course') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i> Tìm kiếm</button>
                <a href="{{ route('admin.quiz_result.all') }}" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>
        <table class="table table-bordered table-striped table-hover shadow-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th> Học viên</th>
                    <th> Khóa học</th>
                    <th> Bài giảng</th>
                    <th> Bài kiểm tra</th>
                    <th> Điểm</th>
                    <th> Thời gian nộp</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $index => $result)
                    <tr>
                        <td>{{ $results->firstItem() + $index }}</td>
                        <td>
                            {{ $result->student->name ?? '---' }}<br>
                            <small class="text-muted">{{ $result->student->email ?? '' }}</small>
                        </td>
                        <td>{{ $result->quiz->lesson->course->title ?? '---' }}</td>
                        <td>{{ $result->quiz->lesson->title ?? '---' }}</td>
                        <td>{{ $result->quiz->title ?? '---' }}</td>
                        <td>{{ round(($result->correct_answers / $result->total_questions) * 10, 2) }}</td>
                        <td>
                            {{ $result->submitted_at ? \Carbon\Carbon::parse($result->submitted_at)->format('d/m/Y H:i') : '---' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Không có kết quả nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $results->appends(['search' => $search, 'student' => $student ?? '', 'quiz' => $quiz ?? '', 'course' => $course ?? ''])->links() }}
        </div>


    </div>
</div>
