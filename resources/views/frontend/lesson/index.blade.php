<!--======================================
        START HEADER AREA
    ======================================-->
<section class="header-menu-area">
    <div class="header-menu-content bg-dark">
        <div class="container-fluid">
            <div class="main-menu-content d-flex align-items-center">
                <div class="logo-box logo--box">
                    <div class="theme-picker d-flex align-items-center">
                        {{-- <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                            <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        </button>
                        <button class="theme-picker-btn light-mode-btn" title="Light mode">
                            <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                        </button> --}}
                    </div>
                </div><!-- end logo-box -->
                <div class="course-dashboard-header-title pl-4">
                    <a href="course-details.html" class="text-white fs-15">{{ $course->title }}</a>
                </div><!-- end course-dashboard-header-title -->
                <div class="menu-wrapper ml-auto">
                    {{-- <div class="theme-picker d-flex align-items-center mr-3">
                        <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                            <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        </button>
                        <button class="theme-picker-btn light-mode-btn" title="Light mode">
                            <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="nav-right-button d-flex align-items-center">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2"
                            data-toggle="modal" data-target="#ratingModal"><i class="la la-star mr-1"></i> leave a
                            rating</a>
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2"
                            data-toggle="modal" data-target="#shareModal"><i class="la la-share mr-1"></i> share</a>
                        <div class="generic-action-wrap generic--action-wrap">
                            <div class="dropdown">
                                <a class="action-btn" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Favorite this course</a>
                                    <a class="dropdown-item" href="#">Archive this course</a>
                                    <a class="dropdown-item" href="#">Gift this course</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end nav-right-button --> --}}
                </div><!-- end menu-wrapper -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
</section><!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->

<!--======================================
        START COURSE-DASHBOARD
======================================-->


<section class="course-dashboard">
    <div class="course-dashboard-wrap">
        <div class="course-dashboard-container d-flex">
            <div class="course-dashboard-column">
                <div class="lecture-viewer-container">
                    @php
                        function convertYoutubeToEmbed($url)
                        {
                            preg_match('/watch\?v=([^\&]+)/', $url, $matches);
                            return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : $url;
                        }
                    @endphp

                    <iframe width="100%" height="500" src="{{ convertYoutubeToEmbed($lesson->video_url) }}"
                        title="{{ $lesson->title }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>





                </div><!-- end lecture-viewer-container -->
                <div class="lecture-video-detail">
                    <div class="lecture-tab-body bg-gray p-4">
                        <ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab"
                                    aria-controls="search" aria-selected="false">
                                    <i class="la la-search"></i>
                                </a>
                            </li> --}}
                            <li class="nav-item mobile-menu-nav-item">
                                <a class="nav-link" id="course-content-tab" data-toggle="tab" href="#course-content"
                                    role="tab" aria-controls="course-content" aria-selected="false">
                                    Danh sách bài học
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                    role="tab" aria-controls="overview" aria-selected="true">
                                    Tổng quan
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="question-and-ans-tab" data-toggle="tab" href="#question-and-ans"
                                    role="tab" aria-controls="question-and-ans" aria-selected="false">
                                    Q&A
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="announcements-tab" data-toggle="tab" href="#announcements"
                                    role="tab" aria-controls="announcements" aria-selected="false">
                                    Thông báo
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="lecture-video-detail-body">
                        <div class="tab-pane fade active show" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="lecture-overview-wrap">
                                <div class="lecture-overview-item">
                                    <h3 class="fs-24 font-weight-semi-bold pb-2">Thông tin khóa học</h3>
                                    <p>{{ $course->description }}</p>
                                </div><!-- end lecture-overview-item -->

                                <div class="section-block"></div>

                                <div class="lecture-overview-item">
                                    <div class="lecture-overview-stats-wrap d-flex">
                                        <div class="lecture-overview-stats-item">
                                            <h3 class="fs-16 font-weight-semi-bold pb-2">Thông tin cụ thể</h3>
                                        </div><!-- end lecture-overview-stats-item -->
                                        <div class="lecture-overview-stats-item">
                                            @php
                                                $levelNames = [
                                                    'beginner' => 'Cơ bản',
                                                    'intermediate' => 'Trung bình',
                                                    'advanced' => 'Nâng cao',
                                                ];
                                            @endphp
                                            <ul class="generic-list-item">
                                                <li><span>Cấp độ:</span>
                                                    {{ $levelNames[$courseLevel] ?? 'Không xác định' }}</li>
                                                <li><span>Học viên:</span> {{ $course->students->count() }}</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-block"></div>

                                <div class="lecture-overview-item">
                                    <div class="lecture-overview-stats-wrap d-flex">
                                        <div class="lecture-overview-stats-item">
                                            <h3 class="fs-16 font-weight-semi-bold pb-2">Chứng chỉ</h3>
                                        </div><!-- end lecture-overview-stats-item -->
                                        <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                            <p class="pb-3">Nhận được chứng chỉ sau khi hoàn thành khóa học</p>
                                            <a href="#" class="btn theme-btn theme-btn-transparent">Aduca
                                                Chứng chỉ</a>
                                        </div><!-- end lecture-overview-stats-item -->
                                    </div><!-- end lecture-overview-stats-wrap -->
                                </div>

                                <div class="section-block"></div>


                                <div class="lecture-overview-item">
                                    <div class="lecture-overview-stats-wrap d-flex">
                                        <div class="lecture-overview-stats-item">
                                            <h3 class="fs-16 font-weight-semi-bold pb-2">Tính năng</h3>
                                        </div><!-- end lecture-overview-stats-item -->
                                        <div class="lecture-overview-stats-item">
                                            <p>Có sẵn trên <a href="#" class="text-color hover-underline">IOS</a>
                                                và <a href="#" class="text-color hover-underline">Android</a></p>
                                        </div><!-- end lecture-overview-stats-item -->
                                    </div><!-- end lecture-overview-stats-wrap -->
                                </div>

                                <div class="section-block"></div>


                                <div class="lecture-overview-item">
                                    <div class="lecture-overview-stats-wrap d-flex ">
                                        <div class="lecture-overview-stats-item">
                                            <h3 class="fs-16 font-weight-semi-bold pb-2">Giáo viên</h3>
                                        </div><!-- end lecture-overview-stats-item -->
                                        <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                            <div class="media media-card align-items-center">
                                                <a href="teacher-detail.html"
                                                    class="media-img d-block rounded-full avatar-md">
                                                    <img src="{{ asset('storage/' . $course->teacher->avatar) }}"
                                                        alt="Instructor avatar" class="rounded-full">
                                                </a>
                                                <div class="media-body">
                                                    <h5><a href="teacher-detail.html">{{ $course->teacher->nane }}</a>
                                                    </h5>

                                                </div>
                                            </div>
                                            <div class="lecture-owner-profile pt-4">
                                                <ul class="social-icons social-icons-styled">
                                                    <li><a href="#" class="facebook-bg"><i
                                                                class="la la-facebook"></i></a></li>
                                                    <li><a href="#" class="twitter-bg"><i
                                                                class="la la-twitter"></i></a></li>
                                                    <li><a href="#" class="instagram-bg"><i
                                                                class="la la-instagram"></i></a></li>
                                                    <li><a href="#" class="linkedin-bg"><i
                                                                class="la la-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="lecture-owner-decription pt-4">
                                                <p>{{ $course->teacher->description }}</p>
                                            </div>
                                        </div><!-- end lecture-overview-stats-item -->
                                    </div><!-- end lecture-overview-stats-wrap -->
                                </div>
                            </div>
                        </div><!-- end tab-pane -->
                    </div>
                </div>
                <div class="cta-area py-4 bg-gray">

                </div>
            </div>

            <div class="course-dashboard-sidebar-column">
                <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Danh
                    sách khóa
                    học</button>
                <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
                    <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                        <h3 class="fs-18 font-weight-semi-bold">Danh sách khóa học</h3>
                        <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                    </div><!-- end course-dashboard-side-heading -->
                    <div class="course-dashboard-side-content">
                        <div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">
                            @foreach ($sections as $section)
                                @php
                                    $totalLessons = $section->lessons->count();
                                    $learnedLessons = $section->lessons
                                        ->filter(function ($lesson) use ($studentId) {
                                            return $lesson->students->contains($studentId);
                                        })
                                        ->count();
                                @endphp

                                <div class="card">
                                    <div class="card-header" id="heading{{ $section->id }}">
                                        <button class="btn btn-link {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-toggle="collapse"
                                            data-target="#collapse{{ $section->id }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $section->id }}">
                                            <i class="la la-angle-down"></i>
                                            <i class="la la-angle-up"></i>
                                            <span class="fs-15">{{ $section->title }}</span>
                                            <span class="course-duration">
                                                <span>{{ $learnedLessons }}/{{ $totalLessons }}</span>
                                            </span>
                                        </button>
                                    </div>

                                    <div id="collapse{{ $section->id }}"
                                        class="collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $section->id }}"
                                        data-parent="#accordionCourseExample">
                                        <div class="card-body p-0">
                                            <ul class="curriculum-sidebar-list">
                                                @foreach ($section->lessons as $lessonItem)
                                                    @php
                                                        $isCurrent = $lessonItem->id == $currentLessonId;
                                                        $isResource = Str::contains(strtolower($lessonItem->title), [
                                                            'download',
                                                            'resource',
                                                            'footage',
                                                        ]);
                                                        $hasLearned = $lessonItem->students->contains($studentId);
                                                    @endphp
                                                    <li
                                                        class="course-item-link {{ $isCurrent ? 'active' : '' }} {{ $isResource ? 'active-resource' : '' }}">
                                                        <div class="course-item-content-wrap">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="lessonCheckbox{{ $lessonItem->id }}"
                                                                    {{ $hasLearned ? 'checked' : '' }} disabled>
                                                                <label
                                                                    class="custom-control-label custom--control-label"
                                                                    for="lessonCheckbox{{ $lessonItem->id }}"></label>
                                                            </div>
                                                            <div class="course-item-content">
                                                                <h4 class="fs-15">
                                                                    {{ $loop->iteration }}.
                                                                    <a href="{{ route('lessons.show', $lessonItem->id) }}"
                                                                        class="{{ $hasLearned ? '' : 'not-enrolled' }}"
                                                                        data-lesson="{{ $lessonItem->title }}">
                                                                        {{ $lessonItem->title }}
                                                                </h4>
                                                                <div class="courser-item-meta-wrap">
                                                                    <p class="course-item-meta">
                                                                        @if ($isResource)
                                                                            <i class="la la-file"></i>Tài
                                                                            liệu
                                                                        @else
                                                                            <i class="la la-play-circle"></i>Video
                                                                        @endif
                                                                    </p>

                                                                    @if ($isResource)
                                                                        <div class="generic-action-wrap">
                                                                            <div class="dropdown">
                                                                                <a class="btn theme-btn theme-btn-sm theme-btn-transparent mt-1 fs-14 font-weight-medium"
                                                                                    href="#"
                                                                                    data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                    <i
                                                                                        class="la la-folder-open mr-1"></i>
                                                                                    Resources<i
                                                                                        class="la la-angle-down ml-1"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    @if ($lessonItem->document_url)
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ asset('storage/' . $lessonItem->document_url) }}"
                                                                                            download>
                                                                                            {{ basename($lessonItem->document_url) }}
                                                                                        </a>
                                                                                    @else
                                                                                        <span
                                                                                            class="dropdown-item text-muted">Không
                                                                                            có tài
                                                                                            liệu</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div><!-- end card-body -->
                                    </div><!-- end collapse -->
                                </div><!-- end card -->
                            @endforeach
                        </div><!-- end accordion -->

                    </div><!-- end course-dashboard-sidebar-column -->
                </div><!-- end course-dashboard-container -->
            </div><!-- end course-dashboard-wrap -->
</section><!-- end course-dashboard -->
<!--======================================
        END COURSE-DASHBOARD
======================================-->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
