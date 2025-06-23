<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Danh sách bài giảng</h2>
        <table class="table table-bordered table-striped table-hover align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tên bài giảng</th>
                    <th>Khóa học</th>
                    <th>Nội dung</th>
                    <th>Video</th>
                    <th>Tài liệu</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $index => $lesson)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->course->title ?? '---' }}</td>
                        <td>{{ Str::limit($lesson->content, 50) }}</td>
                        <td>
                            @if($lesson->video_url)
                                <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="bx bx-video"></i> Xem video
                                </a>
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>
                            @if($lesson->document_url)
                                <a href="{{ $lesson->document_url }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="bx bx-file"></i> Xem tài liệu
                                </a>
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.lesson.delete', $lesson->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa bài giảng này?');">
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