<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary">Danh sách khóa học</h3>
        <a href="{{ route('teacher.course.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Thêm khóa học
        </a>
    </div>
    @php
        $level_vi = [
            'beginner' => 'Cơ bản',
            'intermediate' => 'Trung cấp',
            'advanced' => 'Nâng cao',
        ];
        $level_class = [
            'beginner' => 'level-basic',
            'intermediate' => 'level-intermediate',
            'advanced' => 'level-advanced',
        ];
    @endphp
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-primary shadow">

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Ảnh đại diện</th>
                        <th>Tên khóa học</th>
                        <th>Danh mục</th>
                        <th>Mô tả</th>
                        <th>Trình độ</th>
                        <th>Giáo viên</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($course->avatar)
                                    <img src="{{ asset('storage/' . $course->avatar) }}" alt="avatar"
                                        style="max-width:60px;">
                                @endif
                            </td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->category->name ?? 'Chưa phân loại' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($course->description, 50) }}</td>
                            <td>
                                {{ $level_vi[$course->level] ?? $course->level }}</td>
                            <td>{{ $course->teacher->name ?? 'Chưa gán' }}</td>
                            <td>
                                <a href="{{ route('teacher.lesson', $course->id) }}"
                                    class="btn btn-sm btn-outline-success">
                                    <i class="bx bx-edit"></i> Xem bài giảng
                                </a>
                                <a href="{{ route('teacher.course.edit', $course->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-edit"></i> Sửa
                                </a>
                                <form action="{{ route('teacher.course.delete', $course->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Không có khóa học nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
