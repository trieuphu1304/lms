<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary">Danh sách chương học</h3>
        <a href="{{ route('teacher.section.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Thêm chương học
        </a>
    </div>
    <form method="GET" action="{{ route('teacher.section') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="section" class="form-control" placeholder="Tìm theo tên chương"
                value="{{ request('section') }}">
        </div>
        <div class="col-md-4">
            <input type="text" name="course" class="form-control" placeholder="Tìm theo tên khóa học"
                value="{{ request('course') }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-search"></i> Tìm kiếm
            </button>
            <a href="{{ route('teacher.section') }}" class="btn btn-secondary">Đặt lại</a>
        </div>
    </form>
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
                        <th>Tên chương học</th>
                        <th>Tên khóa học</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $index => $section)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $section->title }}</td>
                            <td>
                                {{ $section->course->title }}
                            </td>

                            <td>
                                <a href="{{ route('teacher.section.edit', $section->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-edit"></i> Sửa
                                </a>
                                <form action="{{ route('teacher.section.delete', $section->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa chương học này?');">
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
                            <td colspan="5" class="text-center text-muted">Không có chương học nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $sections->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>
