<div class="page-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách tài khoản</h2>
            <a href="{{ route('admin.account.create') }}" class="btn btn-success">
                <i class="bx bx-plus"></i> Thêm tài khoản
            </a>
        </div>
        <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $acc)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $acc->name }}</td>
                        <td>{{ $acc->email }}</td>
                        <td>
                            <span
                                class="badge 
                                @if ($acc->role == 'admin') bg-danger
                                @elseif($acc->role == 'teacher') bg-info
                                @else bg-secondary @endif
                            ">
                                {{ ucfirst($acc->role) }}
                            </span>
                        </td>
                        <td>{{ $acc->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.account.edit', $acc->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bx bx-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.account.delete', $acc->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?');">
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
