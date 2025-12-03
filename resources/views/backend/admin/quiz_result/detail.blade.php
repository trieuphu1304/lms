    <div class="page-content">
        <div class="container">
            <h2>Kết quả bài kiểm tra: {{ $quiz->title }}</h2>
            <p><strong>Điểm trung bình lớp:</strong> {{ number_format($classAvgScore * 10, 1) }}</p>

            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Học viên</th>
                        <th>Tổng số câu hỏi</th>
                        <th>Số câu đúng</th>
                        <th>Điểm</th>
                        <th>Ngày làm</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($results as $index => $result)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $result->student->name ?? 'Không xác định' }}</td>
                            {{-- Tổng số câu hỏi --}}
                            <td>{{ $result->total_questions }}</td>

                            {{-- Số câu đúng --}}
                            <td>{{ $result->correct_answers }}</td>
                            <td>{{ round(($result->correct_answers / $result->total_questions) * 10, 2) }}</td>
                            <td>{{ $result->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.quiz') }}" class="btn btn-secondary mt-3">
                <i class="bx bx-arrow-back"></i> Quay lại danh sách bài kiểm tra
            </a>

        </div>
