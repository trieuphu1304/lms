<div class="page-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách khóa học</h2>
            <a href="{{ route('admin.course.create') }}" class="btn btn-success">
                <i class="bx bx-plus"></i> Thêm khóa học
            </a>
        </div>
        <table class="table table-bordered table-striped table-hover align-middle shadow-sm mb-4">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tên khóa học</th>
                    <th>Mô tả</th>
                    <th>Cấp độ</th>
                    <th>Giáo viên</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $index => $course)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ Str::limit($course->description, 50) }}</td>
                        <td>
                            <span
                                class="badge 
                                @if ($course->level == 'beginner') bg-success
                                @elseif($course->level == 'intermediate') bg-info
                                @else bg-warning @endif
                            ">
                                {{ ucfirst($course->level) }}
                            </span>
                        </td>
                        <td>
                            {{ optional($course->teacher)->name ?? 'Chưa gán' }}
                        </td>
                        <td>{{ $course->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.lesson', $course->id) }}" class="btn btn-info">
                                <i class="bx bx-bar-chart"></i> Xem bài giảng
                            </a>
                            <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bx bx-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.course.delete', $course->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Bạn có chắc muốn xóa khóa học này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Thêm vào đầu file hoặc vị trí bạn muốn hiển thị biểu đồ -->
        <div class="card mb-4 mt-6">
            <div class="card-header bg-primary text-white">
                <strong>Biểu đồ số lượng khóa học đang hoạt động theo giảng viên</strong>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                    @foreach ($teacherNames as $i => $name)
                        <span class="border px-1 rounded cursor-pointer">
                            <i class="bx bxs-circle me-1" style="color: #007bff"></i>{{ $name }}
                        </span>
                    @endforeach
                </div>
                <div class="chart-container-1">
                    <canvas id="courseBarChart" width="1333" height="390"
                        style="display: block; box-sizing: border-box; height: 260px; width: 888px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var labels = {!! json_encode($teacherNames ?? []) !!};
            var data = {!! json_encode($courseCounts ?? []) !!};

            var ctx = document.getElementById('courseBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Số lượng khóa học',
                        data: data,
                        backgroundColor: '#007bff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        });
    </script>
@endpush
