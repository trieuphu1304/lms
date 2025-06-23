<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-warning text-white d-flex align-items-center">
                <i class="bx bx-edit fs-4 me-2"></i>
                <h4 class="mb-0">Chỉnh sửa khóa học</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-book"></i> Tên khóa học</label>
                        <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-detail"></i> Mô tả</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ $course->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-layer"></i> Cấp độ</label>
                        <select name="level" class="form-select" required>
                            <option value="beginner" @if($course->level == 'beginner') selected @endif class="text-success">Cơ bản</option>
                            <option value="intermediate" @if($course->level == 'intermediate') selected @endif class="text-info">Trung bình</option>
                            <option value="advanced" @if($course->level == 'advanced') selected @endif class="text-warning">Nâng cao</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-user"></i> Giáo viên</label>
                        <select name="teacher_id" class="form-select" required>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @if($course->teacher_id == $teacher->id) selected @endif>
                                    {{ $teacher->name }} ({{ $teacher->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.course') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bx bx-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>