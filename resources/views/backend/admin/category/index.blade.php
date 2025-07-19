<div class="page-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách danh mục</h2>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                <i class="bx bx-plus"></i> Thêm danh mục
            </a>
        </div>

        <table class="table table-bordered table-striped table-hover align-middle shadow-sm mb-4">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Ảnh đại diện</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if ($category->avatar)
                                <img src="{{ asset('storage/' . $category->avatar) }}" alt="avatar"
                                    style="max-width:60px;">
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="btn btn-sm btn-warning me-1">
                                <i class="bx bx-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
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
    </div>
</div>
