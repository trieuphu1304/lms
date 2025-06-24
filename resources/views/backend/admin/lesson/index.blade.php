<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Danh sách bài giảng của khóa: {{ $course->title }}</h2>
        @if ($lessons->count())
            <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên bài giảng</th>
                        <th>Nội dung</th>
                        <th>Video</th>
                        <th>Tài liệu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $index => $lesson)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ Str::limit($lesson->content, 50) }}</td>
                            <td>
                                @if ($lesson->video_url)
                                    <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bx bx-video"></i> Xem video
                                    </a>
                                @else
                                    <span class="text-muted">Không có</span>
                                @endif
                            </td>
                            <td>
                                @if ($lesson->document_url)
                                    <a href="{{ $lesson->document_url }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bx bx-file"></i> Xem tài liệu
                                    </a>
                                @else
                                    <span class="text-muted">Không có</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">Khóa học này chưa có bài giảng nào.</div>
        @endif
    </div>
</div>
