<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Danh sách phản hồi</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Học viên</th>
                    <th>Khóa học</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $feedbacks->firstItem() + $index }}</td>
                        <td>
                            {{ $feedback->user->name ?? '---' }}<br>
                            <small class="text-muted">{{ $feedback->user->email ?? '' }}</small>
                        </td>
                        <td>{{ $feedback->course->title ?? '---' }}</td>
                        <td>{{ $feedback->content }}</td>
                        <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.feedback.delete', $feedback->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Bạn có chắc muốn xóa phản hồi này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Chưa có phản hồi nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
