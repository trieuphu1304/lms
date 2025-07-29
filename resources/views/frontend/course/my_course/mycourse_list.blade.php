<div class="row" id="course-list">
    @if ($courses->count())
        @foreach ($courses as $course)
            <div class="col-lg-4 responsive-column-half mb-4">
                <div class="card card-item">
                    <div class="card-image">
                        <a href="{{ route('course.detail', $course->id) }}" class="d-block">
                            <img class="card-img-top lazy"
                                src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                                alt="Course image">
                        </a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('course.detail', $course->id) }}">
                                {{ $course->title }}
                            </a>
                        </h5>
                        <p class="card-text lh-22 pt-2">{{ $course->teacher->name ?? 'Giáo viên' }}</p>

                        {{-- Tiến độ học --}}
                        <div class="my-course-progress-bar-wrap d-flex align-items-center mt-3">
                            <p class="skillbar-title">Hoàn thành:</p>
                            <div class="skillbar-box">
                                @php $progress = $course->pivot->progress ?? 0; @endphp
                                <div class="skillbar skillbar-skillbar-2" data-percent="{{ $progress }}%">
                                    <div class="skillbar-bar skillbar--bar-2 bg-1" style="width: {{ $progress }}%;">
                                    </div>
                                </div>
                            </div>
                            <div class="skill-bar-percent">{{ $progress }}%</div>
                        </div>

                        {{-- Đánh giá --}}
                        <div class="review-stars mt-2">
                            <span class="rating-number">{{ number_format($course->ratings ?? 0, 1) }}</span>
                            @php $rating = floor($course->ratings ?? 0); @endphp
                            {!! str_repeat('<span class="la la-star"></span>', $rating) !!}
                            {!! str_repeat('<span class="la la-star-o"></span>', 5 - $rating) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="col-12">
            <div class="text-center pt-3">
                {{ $courses->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @else
        <div class="col-12">
            <div class="alert alert-warning text-center">
                <i class="la la-info-circle mr-1"></i> Không có khóa học nào phù hợp với tiêu chí lọc.
            </div>
        </div>
    @endif
</div>
