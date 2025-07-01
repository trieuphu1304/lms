<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title text-primary mb-0">
            Danh sách bài giảng của khóa học
            <span class="text-secondary fw-semibold">{{ $course->title }}</span>
        </h3>



        <div class="d-flex gap-2">
            <a href="{{ route('teacher.course') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Quay lại khóa học
            </a>
            <a href="{{ route('teacher.lesson.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm bài giảng
            </a>
        </div>
    </div>



    <table class="table table-hover table-bordered border-primary">
        <thead class="table-primary">
            <tr>
                <th>Tiêu đề</th>
                <th>Khóa học</th>
                <th>Video</th>
                <th>Tài liệu</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        @if ($lessons->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-muted">Không có bài giảng nào.</td>
            </tr>
        @endif
        <tbody>
            @foreach ($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ $lesson->course->title }}</td>
                    <td>
                        @if ($lesson->video_url)
                            <a href="{{ $lesson->video_url }}" target="_blank">Xem video</a>
                        @else
                            Không có
                        @endif
                    </td>
                    <td>
                        @if ($lesson->document_url)
                            <a href="{{ $lesson->document_url }}" target="_blank">Xem tài liệu</a>
                        @else
                            Không có
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('teacher.lesson.quizzes', ['lesson' => $lesson->id]) }}"
                            class="btn btn-sm btn-outline-success">Xem bài kiểm tra</a>

                        <a href="{{ route('teacher.lesson.edit', $lesson->id) }}"
                            class="btn btn-sm btn-outline-warning">Sửa</a>
                        <form action="{{ route('teacher.lesson.delete', $lesson->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn muốn xóa bài giảng này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
