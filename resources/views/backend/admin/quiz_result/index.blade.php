<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Kết quả bài kiểm tra: {{ $quiz->title }}</h2>
        <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>👨‍🎓 Học viên</th>
                    <th>✅ Trạng thái</th>
                    <th>🔢 Điểm số</th>
                    <th>📅 Thời gian nộp bài</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                {{-- Học viên đã làm bài --}}
                @foreach ($results as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $result->student->name ?? '---' }}<br>
                            <small class="text-muted">{{ $result->student->email ?? '' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-success">Đã hoàn thành</span>
                        </td>
                        <td>{{ $result->score ?? '---' }}</td>
                        <td>
                            {{ $result->submitted_at ? \Carbon\Carbon::parse($result->submitted_at)->format('d/m/Y H:i') : '---' }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.quiz_result.detail', $result->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-show"></i> Xem chi tiết
                            </a>
                        </td>
                    </tr>
                @endforeach

                {{-- Học viên chưa làm bài --}}
                @foreach ($notDoneStudents as $student)
                    <tr>
                        <td>--</td>
                        <td>
                            {{ $student->name }}<br>
                            <small class="text-muted">{{ $student->email }}</small>
                        </td>
                        <td>
                            <span class="badge bg-secondary">Chưa làm</span>
                        </td>
                        <td>---</td>
                        <td>---</td>
                        <td class="text-center">
                            <span class="text-muted">---</span>
                        </td>
                    </tr>
                @endforeach

                @if ($results->isEmpty() && $notDoneStudents->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-muted">Chưa có học viên nào trong lớp này.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a href="{{ route('admin.quiz') }}" class="btn btn-secondary mt-3">
            <i class="bx bx-arrow-back"></i> Quay lại danh sách bài kiểm tra
        </a>
    </div>
</div>
