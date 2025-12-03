<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Danh sách đánh giá</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Học viên</th>
                    <th>Khóa học</th>
                    <th>Rating</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                </tr>
            </thead>

            <tbody>
                @forelse($reviews as $index => $review)
                    <tr>
                        <td>{{ $reviews->firstItem() + $index }}</td>

                        {{-- Học viên --}}
                        <td>
                            {{ $review->student->name ?? ($review->name ?? '---') }}<br>
                            <small class="text-muted">
                                {{ $review->student->email ?? ($review->email ?? '') }}
                            </small>
                        </td>

                        {{-- Khóa học --}}
                        <td>{{ $review->course->title ?? '---' }}</td>

                        {{-- Rating --}}
                        <td>
                            {{ $review->rating }}/5
                        </td>

                        {{-- Nội dung --}}
                        <td>{{ $review->message }}</td>

                        {{-- Thời gian --}}
                        <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Chưa có phản hồi nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
