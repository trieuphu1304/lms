<div class="content container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">Kết quả bài kiểm tra</h3>

        <a href="{{ route('teacher.question', ['quiz' => $quiz->id]) }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Quay lại danh sách câu hỏi
        </a>

    </div>


    <div class="card shadow border-primary">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Học viên</th>
                        <th>Email</th>
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
                            <td>{{ $result->correct_answers }}</td>
                            <td>{{ $result->total_questions }}</td>
                            <td>{{ round(($result->correct_answers / $result->total_questions) * 10, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($result->submitted_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Chưa có kết quả nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
