<div class="page-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách chương</h2>

        </div>
        <form method="GET" action="{{ route('admin.section') }}" class="row g-3 mb-4">
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
                <a href="{{ route('admin.section') }}" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>

        <table class="table table-bordered table-striped table-hover shadow-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th> Tên chương</th>
                    <th> Khóa học</th>
                    <th> Ngày tạo</th>
                    <th> Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sections as $index => $section)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $section->title ?? '---' }}</td>
                        <td>{{ $section->course->title ?? '---' }}</td>
                        <td>{{ $section->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center" style="display: flex; gap: 8px; flex-wrap: nowrap;">

                            <a href="{{ route('admin.section.edit', $section->id) }}"
                                class="btn btn-warning btn-sm me-1"><i class="bx bx-edit"></i>
                            </a>

                            <form action="{{ route('admin.section.delete', $section->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc muốn xóa chương này này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="bx bx-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Không có kết quả nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $sections->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>



    </div>
</div>
