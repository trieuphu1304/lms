<section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
        <div class="col-lg-8 mr-auto">
            <div class="breadcrumb-content">
                <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><a href="#">Khóa học</a></li>
                    <li><a href="#">{{ $course->title }}</a></li>
                </ul>
                <div class="section-heading">
                    <h2 class="section__title">{{ $course->title }}</h2>
                    <p class="section__desc pt-2 lh-30">{{ $course->description }}</p>
                </div><!-- end section-heading -->
                <div class="d-flex flex-wrap align-items-center pt-3">
                    <h6 class="ribbon ribbon-lg mr-2 bg-3 text-white">Hot</h6>
                    <div class="rating-wrap d-flex flex-wrap align-items-center">
                        <div class="review-stars">
                            <span class="rating-number">{{ number_format($averageRating ?? 0, 1) }}</span>
                            @php
                                $rating = floor($averageRating ?? 0);
                            @endphp
                            {!! str_repeat('<span class="la la-star"></span>', $rating) !!}
                            {!! str_repeat('<span class="la la-star-o"></span>', 5 - $rating) !!}
                        </div>
                        <span class="rating-total pl-1">({{ $totalReviews ?? 0 }})</span>
                    </div>

                </div>
            </div><!-- end d-flex -->
            <p class="pt-2 pb-1">Giáo viên phụ trách <a href="teacher-detail.html"
                    class="text-color hover-underline">{{ $course->teacher->name }}</a></p>
            <div class="d-flex flex-wrap align-items-center">
                <p class="pr-3 d-flex align-items-center">
                    <svg class="svg-icon-color-gray mr-1" width="16px" viewBox="0 0 24 24">
                        <path
                            d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z">
                        </path>
                    </svg>
                    Ngày tạo {{ $course->created_at->format('d/m/Y') }}
                </p>
                <p class="pr-3 d-flex align-items-center">
                    <svg class="svg-icon-color-gray mr-1" width="16px" viewBox="0 0 24 24">
                        <path
                            d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 00-1.38-3.56A8.03 8.03 0 0118.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 015.08 16zm2.95-8H5.08a7.987 7.987 0 014.33-3.56A15.65 15.65 0 008.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 01-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z">
                        </path>
                    </svg>
                    English
                </p>
            </div><!-- end d-flex -->
            <div class="bread-btn-box pt-3">
                <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mr-2 mb-2">
                    <i class="la la-heart-o mr-1"></i>
                    <span class="swapping-btn" data-text-swap="Wishlisted" data-text-original="Wishlist">Yêu
                        thích</span>
                </button>
                <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mr-2 mb-2" data-toggle="modal"
                    data-target="#shareModal">
                    <i class="la la-share mr-1"></i>Chia sẻ
                </button>
                <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mb-2" data-toggle="modal"
                    data-target="#reportModal">
                    <i class="la la-flag mr-1"></i>Báo cáo
                </button>
            </div>
        </div><!-- end breadcrumb-content -->
    </div><!-- end col-lg-8 -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE DETAILS AREA
======================================-->
<section class="course-details-area pb-20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 pb-5">
                <div class="course-details-content-wrap pt-90px">

                    <div class="course-overview-card">
                        <h3 class="fs-24 font-weight-semi-bold pb-3">Mô tả</h3>
                        <p class="fs-15 pb-2">{{ $course->description }}</p>

                    </div><!-- end course-overview-card -->
                    <div class="course-overview-card">
                        <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                            <h3 class="fs-24 font-weight-semi-bold">Nội dung khóa học</h3>
                            <div class="curriculum-duration fs-15">
                                <span class="curriculum-total__text mr-2"><strong
                                        class="text-black font-weight-semi-bold">Tổng bài giảng:</strong>
                                    {{ $lessons->count() }}</span>
                                {{-- <span class="curriculum-total__hours"><strong
                                        class="text-black font-weight-semi-bold">Tổng thời gian:</strong>
                                    02:35:47</span> --}}
                            </div>
                        </div>
                        <div class="curriculum-content">
                            @foreach ($course->sections as $section)
                                <div id="accordion" class="generic-accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <button
                                                class="btn btn-link d-flex align-items-center justify-content-between"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                                {{ $course->sections[0]->title }}
                                                <span class="fs-15 text-gray font-weight-medium">
                                                    {{ $course->sections[0]->lessons->count() }} bài giảng
                                                </span>

                                            </button>
                                        </div><!-- end card-header -->
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="generic-list-item">
                                                    @php
                                                        $enrolled = $course->students->contains(Auth::id());
                                                    @endphp

                                                    @foreach ($course->sections[0]->lessons as $lesson)
                                                        <li>
                                                            @if ($enrolled)
                                                                <a href="{{ route('lessons.show', $lesson->id) }}"
                                                                    class="d-flex align-items-center justify-content-between text-color">
                                                                    <span>
                                                                        <i class="la la-play-circle mr-1"></i>
                                                                        {{ $lesson->title }}
                                                                        <span class="ribbon ml-2 fs-13"></span>
                                                                    </span>
                                                                </a>
                                                            @else
                                                                <a href="#"
                                                                    class="d-flex align-items-center justify-content-between text-color not-enrolled"
                                                                    data-lesson="{{ $lesson->title }}">
                                                                    <span>
                                                                        <i class="la la-play-circle mr-1"></i>
                                                                        {{ $lesson->title }}
                                                                        <span class="ribbon ml-2 fs-13"></span>
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <script>
                                                    document.querySelectorAll('.not-enrolled').forEach(function(link) {
                                                        link.addEventListener('click', function(e) {
                                                            e.preventDefault();
                                                            const lesson = this.getAttribute('data-lesson') || 'bài giảng';
                                                            toastr.warning(`Bạn cần đăng ký khóa học để xem "${lesson}".`);
                                                        });
                                                    });
                                                </script>

                                            </div><!-- end card-body -->
                                        </div><!-- end collapse -->
                                    </div><!-- end card -->
                            @endforeach
                        </div><!-- end generic-accordion -->
                    </div><!-- end curriculum-content -->
                </div><!-- end course-overview-card -->




                <div class="course-overview-card pt-4">
                    <h3 class="fs-24 font-weight-semi-bold pb-4">Thông tin giáo viên</h3>
                    <div class="instructor-wrap">
                        <div class="media media-card">
                            <div class="instructor-img">
                                <a href="teacher-detail.html" class="media-img d-block">
                                    @if ($course->teacher && $course->teacher->avatar)
                                        <img class="lazy" src="{{ asset('storage/' . $course->teacher->avatar) }}"
                                            data-src="{{ asset('storage/' . $course->teacher->avatar) }}"
                                            alt="Avatar Teacher">
                                    @else
                                        <img class="lazy" src="{{ asset('storage/default-avatar.jpg') }}"
                                            data-src="{{ asset('storage/default-avatar.jpg') }}" alt="Default Avatar">
                                    @endif

                                </a>
                                <ul class="generic-list-item pt-3">
                                    <li><i class="la la-star mr-2 text-color-3"></i> 4.6 Instructor Rating</li>
                                    <li><i class="la la-user mr-2 text-color-3"></i> {{ $totalStudents }} Học viên
                                    </li>
                                    <li><i class="la la-comment-o mr-2 text-color-3"></i> 2,533 Reviews</li>
                                    <li><i class="la la-play-circle-o mr-2 text-color-3"></i> {{ $totalCourses }} Khóa
                                        học</li>
                                    <li><a href="teacher-detail.html"></a></li>
                                </ul>
                            </div><!-- end instructor-img -->
                            <div class="media-body">
                                <h5><a href="teacher-detail.html">{{ $course->teacher->name }}</a></h5>
                                <span class="d-block lh-18 pt-2 pb-3">
                                    Thời gian dạy: {{ $user->created_at->diffForHumans() }}
                                </span>

                                <p class="text-black lh-18 pb-3"></p>
                                <p class="pb-3">{{ $course->teacher->description }}</p>
                                <div class="collapse" id="collapseMoreTwo">
                                    <p class="pb-3"> </p>
                                </div>
                                <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse"
                                    href="#collapseMoreTwo" role="button" aria-expanded="false"
                                    aria-controls="collapseMoreTwo">
                                    <span class="collapse-btn-hide">Show more<i
                                            class="la la-angle-down ml-1 fs-14"></i></span>
                                    <span class="collapse-btn-show">Show less<i
                                            class="la la-angle-up ml-1 fs-14"></i></span>
                                </a>
                            </div>
                        </div>
                    </div><!-- end instructor-wrap -->
                </div><!-- end course-overview-card -->
                <div class="course-overview-card pt-4">
                    <h3 class="fs-24 font-weight-semi-bold pb-40px">Đánh giá của học viên</h3>
                    <div class="feedback-wrap">
                        <div class="media media-card align-items-center">
                            <div class="review-rating-summary">
                                <span class="stats-average__count">{{ $averageRating }}</span>
                                <div class="rating-wrap pt-1">
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($averageRating))
                                                <span class="la la-star"></span>
                                            @elseif ($i - $averageRating < 1)
                                                <span class="la la-star-half-alt"></span>
                                            @else
                                                <span class="la la-star-o"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="rating-total d-block">({{ $totalReviews }})</span>
                                    <span>Đánh giá</span>
                                </div>
                            </div>
                            <div class="media-body">
                                @foreach ([5, 4, 3, 2, 1] as $star)
                                    @php
                                        $percent =
                                            $totalReviews > 0
                                                ? round(($ratingBreakdown[$star] / $totalReviews) * 100)
                                                : 0;
                                    @endphp
                                    <div class="review-bars d-flex align-items-center mb-2">
                                        <div class="review-bars__text">{{ $star }} stars</div>
                                        <div class="review-bars__fill">
                                            <div class="skillbar-box">
                                                <div class="skillbar" data-percent="{{ $percent }}%">
                                                    <div class="skillbar-bar bg-3"
                                                        style="width: {{ $percent }}%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-bars__percent">{{ $percent }}%</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="reviewList">
                    @foreach ($course->reviews as $review)
                        <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                            <div class="media-img mr-4 rounded-full">
                                <img class="rounded-full lazy" src="{{ asset('images/img-loading.png') }}"
                                    data-src="{{ asset('images/default-avatar.png') }}" alt="User image">
                            </div>
                            <div class="media-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                    <h5>{{ $review->name }}</h5>
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                class="la la-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></span>
                                        @endfor
                                    </div>
                                </div>
                                <span class="d-block lh-18 pb-2">{{ $review->created_at->diffForHumans() }}</span>
                                <p class="pb-2">{{ $review->message }}</p>
                                <div class="helpful-action">
                                    <span class="d-block fs-13">Đánh giá này có hữu ích không?</span>
                                    <button class="btn">Có</button>
                                    <button class="btn">Không</button>
                                    <span class="btn-text fs-14 cursor-pointer pl-1" data-toggle="modal"
                                        data-target="#reportModal">Báo cáo</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



                {{ $reviews->links() }}

                <div class="course-overview-card pt-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('reviews.store', $course->id) }}" id="reviewForm">
                        @csrf
                        <h3 class="fs-24 font-weight-semi-bold pb-4">Thêm đánh giá</h3>

                        <!-- Đánh giá sao -->
                        <div class="leave-rating-wrap pb-4">
                            <div class="leave-rating leave--rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="rating" id="star{{ $i }}"
                                        value="{{ $i }}" required>
                                    <label for="star{{ $i }}"></label>
                                @endfor
                            </div>
                        </div>

                        <!-- Tên và Email -->
                        <div class="row">
                            <div class="input-box col-lg-6 mb-3">
                                <label class="label-text">Tên</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name"
                                        value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                        placeholder="Tên của bạn" {{ Auth::check() ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="input-box col-lg-6 mb-3">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email"
                                        value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                        placeholder="Email của bạn" {{ Auth::check() ? 'readonly' : '' }}>
                                </div>
                            </div>
                        </div>

                        <!-- Nội dung đánh giá -->
                        <div class="input-box col-lg-12">
                            <label class="label-text">Nội dung</label>
                            <div class="form-group">
                                <textarea class="form-control form--control" name="message" placeholder="Viết đánh giá..." rows="5"></textarea>
                            </div>
                        </div>

                        <!-- Checkbox + Submit -->
                        <div class="btn-box col-lg-12">
                            <div class="custom-control custom-checkbox mb-3 fs-15">
                                <input type="checkbox" class="custom-control-input" id="saveCheckbox" required>
                                <label class="custom-control-label" for="saveCheckbox">Tôi đồng ý lưu thông tin đánh
                                    giá này.</label>
                            </div>
                            <button class="btn theme-btn" type="submit">Lưu đánh giá</button>
                        </div>
                    </form>


                </div>
                <script>
                    document.getElementById('reviewForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        let form = e.target;
                        let formData = new FormData(form);

                        let isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                        let isEnrolled = {{ Auth::check() && $course->students->contains(Auth::id()) ? 'true' : 'false' }};
                        let hasReviewed =
                            {{ $course->reviews->where('student_id', Auth::id())->isNotEmpty() ? 'true' : 'false' }};
                        let ratingChecked = document.querySelector('input[name="rating"]:checked');

                        if (!isLoggedIn) {
                            toastr.error('Bạn cần đăng nhập để đánh giá khóa học.');
                            return;
                        }
                        if (!isEnrolled) {
                            toastr.warning('Bạn cần đăng ký khóa học này để đánh giá.');
                            return;
                        }
                        if (!ratingChecked) {
                            toastr.warning('Vui lòng chọn số sao để đánh giá.');
                            return;
                        }
                        if (hasReviewed) {
                            toastr.error('Bạn đã đánh giá khóa học này rồi.');
                            return;
                        }

                        fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                },
                                body: formData
                            })
                            .then(response => {
                                if (!response.ok) throw response;
                                return response.json();
                            })
                            .then(data => {
                                toastr.success(data.message);
                                form.reset();

                                // Gọi lại danh sách review
                                fetch(`{{ route('reviews.fetch', $course->id) }}`)
                                    .then(res => res.text())
                                    .then(html => {
                                        document.getElementById('reviewList').innerHTML = html;
                                    });
                            })
                            .catch(async error => {
                                if (error.status === 422) {
                                    const res = await error.json();
                                    for (let key in res.errors) {
                                        toastr.error(res.errors[key][0]);
                                    }
                                } else if (error.status === 409) {
                                    const res = await error.json();
                                    toastr.error(res.message);
                                } else {
                                    toastr.error('Đã xảy ra lỗi khi gửi đánh giá.');
                                }
                            });
                    });
                </script>





            </div><!-- end course-details-content-wrap -->
        </div><!-- end col-lg-8 -->
        <div class="col-lg-4">
            <div class="sidebar sidebar-negative">
                <div class="card card-item">
                    <div class="card-body">
                        <div class="preview-course-video">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
                                <img src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                                    data-src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                                    alt="course-img" class="w-100 rounded lazy">
                                <div class="preview-course-video-content">
                                    <div class="overlay"></div>
                                    <div class="play-button">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            viewBox="-307.4 338.8 91.8 91.8"
                                            style=" enable-background:new -307.4 338.8 91.8 91.8;"
                                            xml:space="preserve">
                                            <style type="text/css">
                                                .st0 {
                                                    fill: #ffffff;
                                                    border-radius: 100px;
                                                }

                                                .st1 {
                                                    fill: #000000;
                                                }
                                            </style>
                                            <g>
                                                <circle class="st0" cx="-261.5" cy="384.7" r="45.9">
                                                </circle>
                                                <path class="st1"
                                                    d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <p class="fs-15 font-weight-bold text-white pt-3">GIỚI THIỆU KHÓA HỌC</p>
                                </div>
                            </a>
                        </div><!-- end preview-course-video -->
                        <div class="preview-course-feature-content pt-40px">
                            {{-- <p class="d-flex align-items-center pb-2">
                                <span class="fs-35 font-weight-semi-bold text-black">$76.99</span>
                                <span class="before-price mx-1">$104.99</span>
                                <span class="price-discount">24% off</span>
                            </p>
                            <p class="preview-price-discount-text pb-35px">
                                <span class="text-color-3">4 days</span> left at this price!
                            </p> --}}
                            <div class="buy-course-btn-box">
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



                            </div>
                            <p class="fs-14 text-center pb-4"></p>
                            <div class="preview-course-incentives">
                                <h3 class="card-title fs-18 pb-2">Khóa học bao gồm</h3>
                                <ul class="generic-list-item pb-3">
                                    {{-- <li><i class="la la-play-circle-o mr-2 text-color"></i>2.5 hours on-demand
                                        video</li> --}}
                                    <li><i class="la la-file mr-2 text-color"></i>{{ $lessons->count() }} Bài giảng
                                    </li>
                                    {{-- <li><i class="la la-file-text mr-2 text-color"></i>12 downloadable resources --}}
                                    </li>
                                    <li><i class="la la-code mr-2 text-color"></i>{{ $totalQuizzes }} Bài kiểm tra
                                    </li>
                                    <li><i class="la la-key mr-2 text-color"></i>Học mọi lúc</li>
                                    <li><i class="la la-television mr-2 text-color"></i>Học trên điện thoại và máy
                                        tính bảng</li>
                                    </li>
                                    <li><i class="la la-certificate mr-2 text-color"></i>Nhận chứng chỉ khi hoàn thành
                                    </li>
                                </ul>
                                <div class="section-block"></div>
                                <div class="buy-for-team-container pt-4">
                                    {{-- <h3 class="fs-18 font-weight-semi-bold pb-2">Training 5 or more people?</h3>
                                    <p class="lh-24 pb-3">Get your team access to 3,000+ top Aduca courses anytime,
                                        anywhere.</p>
                                    <a href="for-business.html"
                                        class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30 w-100">Try
                                        Aduca for Business</a> --}}
                                </div>
                            </div><!-- end preview-course-incentives -->
                        </div><!-- end preview-course-content -->
                    </div>
                </div><!-- end card -->
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
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-18 pb-2">Tính năng của khóa học</h3>
                        <div class="divider"><span></span></div>
                        <ul class="generic-list-item generic-list-item-flash">
                            {{-- <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-clock mr-2 text-color"></i>Duration</span> 2.5 hours</li> --}}
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-play-circle-o mr-2 text-color"></i>Bài giảng</span>
                                {{ $lessons->count() }}</li>
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-file-text-o mr-2 text-color"></i>Tài liệu</span>
                                {{ $totalDocuments }}</li>
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-bolt mr-2 text-color"></i>Bài kiểm tra</span> {{ $totalQuizzes }}
                            </li>
                            {{-- <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-eye mr-2 text-color"></i>Preview Lessons</span> 4</li> --}}
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-language mr-2 text-color"></i>Language</span> Tiếng anh</li>
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-lightbulb mr-2 text-color"></i>Cấp độ</span>
                                {{ $level_vi[$course->level] ?? $course->level }}
                            </li>
                            </li>
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-users mr-2 text-color"></i>Học viên</span> {{ $courseStudents }}
                            </li>
                            <li class="d-flex align-items-center justify-content-between"><span><i
                                        class="la la-certificate mr-2 text-color"></i>Chứng nhận</span> Có</li>
                        </ul>
                    </div>

                </div><!-- end card -->
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-18 pb-2">Danh mục khóa học</h3>
                        <div class="divider"><span></span></div>
                        <ul class="generic-list-item">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('courses.index') }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div><!-- end card -->
                <div class="card card-item">

                </div><!-- end card -->
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-18 pb-2">Danh sách cấp độ</h3>
                        <div class="divider"><span></span></div>
                        <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                            @foreach ($levels as $level)
                                <li class="mr-2">
                                    <a href="{{ route('courses.index', ['level' => $level]) }}">
                                        {{ $level_vi[$level] ?? ucfirst($level) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- end card -->
            </div><!-- end sidebar -->
        </div><!-- end col-lg-4 -->
    </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end course-details-area -->
<!--======================================
        END COURSE DETAILS AREA
======================================-->

<!--======================================
        START RELATED COURSE AREA
======================================-->
<section class="related-course-area bg-gray pt-60px pb-60px">
    <div class="container">
        <div class="related-course-wrap">
            <h3 class="fs-28 font-weight-semi-bold pb-35px">Các khóa học khác của <a href="teacher-detail.html"
                    class="text-color hover-underline">{{ $course->teacher->name }}</a></h3>
            @if ($otherCourses->count())
                <div class="view-more-carousel-2 owl-action-styled owl-carousel">
                    @foreach ($otherCourses as $item)
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="{{ route('course.detail', $item->id) }}" class="d-block">
                                    <img class="card-img-top"
                                        src="{{ $item->avatar ? asset('storage/' . $item->avatar) : asset('frontend/images/img8.jpg') }}"
                                        alt="{{ $item->title }}">
                                </a>
                                <div class="course-badge-labels">
                                    @if ($item->is_hot)
                                        <div class="course-badge">Hot</div>
                                    @endif
                                    @if ($item->is_bestseller)
                                        <div class="course-badge blue">Bestseller</div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3 {{ $level_class[$course->level] ?? '' }}">
                                    {{ $level_vi[$item->level] ?? $item->level }}</h6>
                                <h5 class="card-title">
                                    <a href="{{ route('course.detail', $item->id) }}">{{ $item->title }}</a>
                                </h5>
                                <p class="card-text">
                                    <a href="#">{{ $item->teacher->name }}</a>
                                </p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">{{ number_format($item->ratings ?? 0, 1) }}</span>
                                        @php
                                            $rating = floor($item->ratings ?? 0);
                                        @endphp
                                        {!! str_repeat('<span class="la la-star"></span>', $rating) !!}
                                        {!! str_repeat('<span class="la la-star-o"></span>', 5 - $rating) !!}
                                    </div>

                                    <span class="rating-total pl-1">({{ $item->reviews->count() ?? 0 }})</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                        title="Yêu thích">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div><!-- end related-course-wrap -->
    </div><!-- end container -->
</section><!-- end related-course-area -->
<!--======================================
        END RELATED COURSE AREA
======================================-->

<!--======================================
        START CTA AREA
======================================-->
<section class="cta-area pt-60px pb-60px position-relative overflow-hidden">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="cta-content-wrap py-4 d-flex flex-wrap align-items-center">
                    <svg class="flex-shrink-0 mr-4" width="70" viewBox="0 -48 496 496"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0">
                        </path>
                        <path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"></path>
                        <path
                            d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0">
                        </path>
                        <path
                            d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0">
                        </path>
                        <path d="m152 288h16v80h-16zm0 0"></path>
                        <path d="m120 288h16v80h-16zm0 0"></path>
                        <path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"></path>
                    </svg>
                    <div class="section-heading">
                        <h2 class="section__title mb-1 fs-22">Trở thành giáo viên, Chia sể kiến thức của bạn</h2>
                        <p class="section__desc">Tạo bài giảng online đến khắp học viên trên thế giới và nhận hoa hồng
                            xứng đáng</p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="cta-btn-box text-right">
                    <a href="become-a-teacher.html" class="btn theme-btn">Giảng dạy với Aduca <i
                            class="la la-arrow-right icon ml-1"></i> </a>
                </div>
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->

<div class="section-block"></div>



<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->
