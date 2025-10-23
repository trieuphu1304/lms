<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">Tất cả phản hồi từ học viên</h3>
    </div>

    <form method="GET" action="{{ route('teacher.feedback') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="student" class="form-control" placeholder="Tìm theo tên học viên"
                value="{{ request('student') }}">
        </div>
        <div class="col-md-4">
            <input type="text" name="course" class="form-control" placeholder="Tìm theo tên khóa học"
                value="{{ request('course') }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i> Tìm kiếm</button>
            <a href="{{ route('teacher.feedback') }}" class="btn btn-secondary">Đặt lại</a>
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
                        <th>Khóa học</th>
                        <th>Ngày gửi</th>
                        <th>Đã đọc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $index => $review)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $review->student->name }}</td>
                            <td>{{ $review->student->email }}</td>
                            <td>{{ $review->course->title ?? 'Không rõ' }}</td>
                            <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($review->is_read)
                                    <span class="badge bg-success">Đã đọc</span>
                                @else
                                    <span class="badge bg-secondary">Chưa đọc</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('teacher.feedback.show', $review->id) }}"
                                    class="btn btn-sm btn-outline-info">
                                    Xem
                                </a>
                                <form action="{{ route('teacher.feedback.delete', $review->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Không có phản hồi nào được ghi nhận.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
