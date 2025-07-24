<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-warning text-dark d-flex align-items-center">
                <i class="bx bx-edit fs-4 me-2"></i>
                <h4 class="mb-0">Chỉnh sửa chương</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.section.update', $section->id) }}" method="POST">
                    @csrf
                    {{-- Hiển thị lỗi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Tên chương --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-book"></i> Tên chương</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $section->title) }}" required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Khóa học --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-category"></i> Khóa học</label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                            <option value="">-- Chọn khóa học --</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ old('course_id', $section->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nút thao tác --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.section') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bx bx-save"></i> Cập nhật chương
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
