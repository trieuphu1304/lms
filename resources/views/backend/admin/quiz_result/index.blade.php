<!-- filepath: c:\xampp\htdocs\lms\resources\views\backend\admin\quiz_result\index.blade.php -->
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
                    <th>📅 Thời gian làm bài</th>
                    <th>⏱️ Thời gian hoàn thành</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $index => $result)
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
                            {{ $result->started_at ? \Carbon\Carbon::parse($result->started_at)->format('d/m/Y H:i') : '---' }}
                        </td>
                        <td>
                            {{ $result->finished_at ? \Carbon\Carbon::parse($result->finished_at)->diffForHumans($result->started_at, true) : '---' }}
                        </td>
                        {{-- <td class="text-center">
                            <a href="{{ route('admin.quiz_result.show', $result->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-show"></i> Xem chi tiết
                            </a>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Chưa có học viên nào làm bài kiểm tra này.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.quiz') }}" class="btn btn-secondary mt-3">
            <i class="bx bx-arrow-back"></i> Quay lại danh sách bài kiểm tra
        </a>
    </div>
</div>