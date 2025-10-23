<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title text-primary mb-0">Chi tiết phản hồi</h3>
        <a href="{{ route('teacher.feedback') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Quay lại danh sách
        </a>
    </div>

    <div class="card border-primary shadow">
        <div class="card-body">
            <h4 class="text-secondary mb-3">{{ $review->title }}</h4>

            <div class="mb-3">
                <strong>Người gửi:</strong> {{ $review->student->name }} ({{ $review->student->email }})
            </div>

            <div class="mb-3">
                <strong>Khóa học:</strong> {{ $review->course->title ?? 'Không rõ' }}
            </div>

            <div class="mb-3">
                <strong>Ngày gửi:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i') }}
            </div>

            <div class="mb-3">
                <strong>Trạng thái:</strong>
                <span class="badge {{ $review->is_read ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $review->is_read ? 'Đã đọc' : 'Chưa đọc' }}
                </span>
            </div>

            <hr>

            <div>
                <strong>Nội dung đánh giá:</strong>
                <div class="mt-2 border rounded p-3 bg-light">
                    {!! nl2br(e($review->message)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
