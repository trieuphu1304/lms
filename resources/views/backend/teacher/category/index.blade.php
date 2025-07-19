<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary">Danh sách danh mục</h3>
        <a href="{{ route('teacher.categories.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Thêm danh mục
        </a>
    </div>

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
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($category->avatar)
                                    <img src="{{ asset('storage/' . $category->avatar) }}" alt="avatar"
                                        style="max-width:60px;">
                                @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($category->description, 50) }}</td>
                            <td>
                                <a href="{{ route('teacher.categories.edit', $category->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-edit"></i> Sửa
                                </a>
                                <form action="{{ route('teacher.categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
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
                            <td colspan="5" class="text-center text-muted">Không có danh mục nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
