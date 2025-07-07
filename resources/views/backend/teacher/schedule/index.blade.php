<div class="content container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary">Danh sách lịch trình</h3>
        <a href="{{ route('teacher.schedule.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Thêm lịch trình
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Khóa học</th>
                <th>Sự kiện</th>
                <th>Thời gian</th>
                <th>Địa điểm</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $schedule->course->title }}</td>
                    <td>{{ $schedule->event }}</td>
                    <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                    <td>{{ $schedule->location ?? '---' }}</td>
                    <td>{{ $schedule->status }}</td>
                    <td>
                        <a href="{{ route('teacher.schedule.edit', $schedule->id) }}"
                            class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('teacher.schedule.delete', $schedule->id) }}" method="POST"
                            class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa lịch trình?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
