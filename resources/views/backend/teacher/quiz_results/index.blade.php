<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">Tất cả kết quả bài kiểm tra</h3>
    </div>

    <form method="GET" action="{{ route('teacher.quiz_results.index') }}" class="row g-3 mb-4">
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
            <a href="{{ route('teacher.quiz_results.index') }}" class="btn btn-secondary">Đặt lại</a>
        </div>
    </form>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-primary shadow">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Học viên</th>
                        <th>Email</th>
                        <th>Bài kiểm tra</th>
                        <th>Bài giảng</th>
                        <th>Khóa học</th>
                        <th>Số câu đúng</th>
                        <th>Tổng câu</th>
                        <th>Điểm</th>
                        <th>Thời gian nộp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($results as $index => $result)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $result->student->name }}</td>
                            <td>{{ $result->student->email }}</td>
                            <td>{{ $result->quiz->title }}</td>
                            <td>{{ $result->quiz->lesson->title }}</td>
                            <td>{{ $result->quiz->lesson->course->title }}</td>
                            <td>{{ $result->correct_answers }}</td>
                            <td>{{ $result->total_questions }}</td>
                            <td>{{ round(($result->correct_answers / $result->total_questions) * 10, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($result->submitted_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Chưa có kết quả nào được ghi nhận.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
