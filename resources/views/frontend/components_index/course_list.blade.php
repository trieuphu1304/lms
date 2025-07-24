@php
    $level_vi = [
        'beginner' => 'Cơ bản',
        'intermediate' => 'Trung cấp',
        'advanced' => 'Nâng cao',
    ];
    $level_class = [
        'beginner' => 'level-basic',
        'intermediate' => 'level-intermediate',
        'advanced' => 'level-advanced',
    ];
@endphp
@forelse($courses as $course)
    <div class="col-lg-4 responsive-column-half">
        <div class="card card-item card-preview">
            <div class="card-image">
                <a href="course-details.html" class="d-block">
                    <img class="card-img-top lazy"
                        src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                        alt="Ảnh khóa học">
                </a>
                <div class="course-badge-labels">
                    <div class="course-badge">Hot</div>
                    <div class="course-badge blue">Mới</div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="fs-14 mb-3 ribbon {{ $level_class[$course->level] ?? '' }}">
                    {{ $level_vi[$course->level] ?? $course->level }}
                </h6>
                <h5 class="card-title"><a href="{{ route('course.detail', $course->id) }}">{{ $course->title }}</a></h5>
                <p class="card-text">
                    <a href="teacher-detail.html">
                        Giáo viên: {{ $course->teacher->name ?? 'Chưa có giáo viên' }}
                    </a>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    @if (Auth::check() && Auth::user()->role === 'student')
                        @if (!$course->students->contains(Auth::id()))
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn theme-btn w-100 mb-2"><i
                                        class="la la-success fs-18 mr-1"></i>Đăng ký khóa
                                    học</button>
                            </form>
                        @else
                            <button class="btn btn-success" disabled>Đã đăng ký</button>
                        @endif
                    @else
                        <a href="{{ route('student.login') }}" class="btn btn-info">Đăng nhập để đăng
                            ký</a>
                    @endif
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                        title="Thêm vào danh sách yêu thích">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center">
        <p>Không có khóa học nào.</p>
    </div>
@endforelse
