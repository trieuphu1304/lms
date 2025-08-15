<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area py-5 bg-white pattern-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <div class="section-heading">
                <h2 class="section__title">Khóa học của tôi</h2>
            </div><!-- end section-heading -->
            <ul class="nav nav-tabs generic-tab pt-30px" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-course-tab" data-toggle="tab" href="#all-course" role="tab"
                        aria-controls="all-course" aria-selected="false">
                        Tất cả
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab"
                        aria-controls="wishlist" aria-selected="false">
                        Yêu thích
                    </a>
                </li>

            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START MY COURSES
================================= -->
<section class="my-courses-area pt-30px pb-90px">
    <div class="container">
        <div class="my-course-content-wrap">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all-course" role="tabpanel" aria-labelledby="all-course-tab">
                    <div class="my-course-body">
                        <div class="alert alert-info alert-dismissible fade show course-alert-info" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="la la-users fs-40"></i> <a href="invite.html"
                                    class="alert-link font-weight-medium pl-4">Chia sẻ Aduca đến bạn bè</a>
                            </div>
                            <button type="button" class="close fs-20" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" class="la la-times"></span>
                            </button>
                        </div><!-- end alert -->
                        <div class="my-course-filter-wrap pt-2">
                            {{-- Form lọc --}}
                            @include('frontend.course.my_course._filter_form')
                        </div>

                        <div class="my-course-cards pt-40px">
                            <div id="course-list" class="mt-4">
                                @include('frontend.course.my_course.mycourse_list', [
                                    'courses' => $courses,
                                ])
                            </div>
                        </div>


                    </div><!-- end my-course-body -->
                </div><!-- end tab-pane -->

                <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                    <div class="my-course-body">
                        <div class="my-course-info pb-40px d-flex flex-wrap align-items-center justify-content-between">
                            <h3 class="fs-22 font-weight-semi-bold">Khóa học yêu thích của tôi</h3>
                            <div class="my-course-filter-item">

                            </div>
                        </div><!-- end my-course-info -->
                        <div class="my-course-cards">
                            <div class="row">
                                @if ($wishlistCourses->count())
                                    @foreach ($wishlistCourses as $course)
                                        <div class="col-lg-4 responsive-column-half mb-4"
                                            id="wishlist-course-{{ $course->id }}">
                                            <div class="card card-item h-100 d-flex flex-column">
                                                <div class="card-image">
                                                    <a href="{{ route('course.detail', $course->id) }}" class="d-block">
                                                        <img class="card-img-top lazy"
                                                            src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                                                            alt="Course image">
                                                    </a>
                                                </div>
                                                <div class="card-body d-flex flex-column">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h5 class="card-title mb-0">
                                                            <a href="{{ route('course.detail', $course->id) }}">
                                                                {{ $course->title }}
                                                            </a>
                                                        </h5>

                                                    </div>
                                                    <p class="card-text lh-22 pt-2">
                                                        {{ $course->teacher->name ?? 'Giáo viên' }}
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="review-stars">
                                                            <span
                                                                class="rating-number">{{ number_format($course->ratings ?? 0, 1) }}</span>
                                                            @php $rating = floor($course->ratings ?? 0); @endphp
                                                            {!! str_repeat('<span class="la la-star"></span>', $rating) !!}
                                                            {!! str_repeat('<span class="la la-star-o"></span>', 5 - $rating) !!}
                                                        </div>
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="removeFromWishlist({{ $course->id }})"
                                                            title="Xóa khỏi yêu thích">
                                                            <i class="la la-trash"></i>
                                                        </button>
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
                                            <i class="la la-info-circle mr-1"></i> Không có khóa học nào yêu thích nào.
                                        </div>
                                    </div>
                                @endif
                            </div><!-- end row -->
                        </div><!-- end my-course-cards -->
                    </div><!-- end my-course-body -->
                </div><!-- end tab-pane -->
            </div><!-- end tab-content -->


        </div>
    </div><!-- end container -->
</section><!-- end my-courses-area -->
<!-- ================================
       START MY COURSES
================================= -->

<!--======================================
        START CTA AREA
======================================-->
<section class="cta-area py-5 bg-gray position-relative overflow-hidden">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="cta-content-wrap">
                    <h3 class="fs-20 font-weight-semi-bold lh-28">Top companies choose <a href="for-business.html"
                            class="text-color hover-underline">Aduca for Business</a> to build in-demand career
                        skills.</h3>
                </div>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">
                <div class="client-logo-wrap text-right">
                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                            src="{{ asset('frontend/images/sponsor-img.png') }}" alt="brand image"></a>
                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                            src="{{ asset('frontend/images/sponsor-img2.png') }}" alt="brand image"></a>
                    <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img
                            src="{{ asset('frontend/images/sponsor-im   g3.png') }}" alt="brand image"></a>
                </div><!-- end client-logo-wrap -->
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->
