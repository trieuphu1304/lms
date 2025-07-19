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
@foreach ($courses as $course)
    <div class="col-lg-12">
        <div class="card card-item card-preview card-item-list-layout tooltipstered"
            data-tooltip-content="#tooltip_content_1">
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
            </div><!-- end card-image -->
            <div class="card-body">
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3 {{ $level_class[$course->level] ?? '' }}">
                    {{ $level_vi[$course->level] ?? $course->level }}</h6>
                <h5 class="card-title"><a href="course-details.html">{{ $course->title }}</a></h5>
                <p class="card-text"><a href="teacher-detail.html">Giáo viên:
                        {{ $course->teacher->name ?? 'Chưa có giáo viên' }}</a></p>
                <div class="rating-wrap d-flex align-items-center py-2">

                </div><!-- end rating-wrap -->
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn theme-btn">Đăng kí</button>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i
                            class="la la-heart-o"></i></div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col-lg-12 -->
@endforeach
