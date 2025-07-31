<div class="content container-fluid">
    <div class="page-header">
        <h3 class="page-title">Quản lý học viên</h3>
    </div>

    @foreach ($courses as $course)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ $course->title }} ({{ $course->students->count() }} học viên)</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Tiến độ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($course->students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->pivot->progress ?? 0 }}%</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Chưa có học viên.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

</div>
