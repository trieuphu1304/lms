<div class="content container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Chào, {{ Auth::user()->name }}!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Giáo viên</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Tổng số khóa học</h6>
                            <h3>{{ $coursesCount }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/teacher-icon-01.svg') }}"
                                alt="Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Tổng số học viên</h6>
                            <h3>{{ $studentsCount }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/dash-icon-01.svg') }}" alt="Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Tổng số bài học</h6>
                            <h3>{{ $lessonsCount }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/teacher-icon-02.svg') }}"
                                alt="Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Tổng số giờ giảng dạy</h6>
                            <h3>{{ $teachingHours }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/teacher-icon-03.svg') }}"
                                alt="Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-8">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Bài giảng sắp tới</h5>
                                </div>
                                <div class="col-6">
                                    <span class="float-end view-link"><a href="{{ route('teacher.course') }}">Xem tất cả
                                            khóa học</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 pb-3">
                            <div class="table-responsive lesson">
                                <table class="table table-center">
                                    <tbody>
                                        @foreach ($upcomingLessons as $lesson)
                                            <tr>
                                                <td>
                                                    <div class="date">
                                                        <b>{{ $lesson->title }}</b>
                                                        <p>{{ $lesson->course->title }}</p>
                                                        <ul class="teacher-date-list">
                                                            <li><i
                                                                    class="fas fa-calendar-alt me-2"></i>{{ $lesson->start_time->format('d/m/Y') }}
                                                            </li>
                                                            <li>|</li>
                                                            <li><i
                                                                    class="fas fa-clock me-2"></i>{{ $lesson->start_time->format('H:i') }}
                                                                - {{ $lesson->end_time->format('H:i') }}</li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="lesson-confirm">
                                                        <a href="#">Đã xác nhận</a>
                                                    </div>
                                                    <a href="#" class="btn btn-info">Đặt lại lịch</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Tiến độ học kỳ</h5>
                                </div>
                            </div>
                        </div>
                        <div class="dash-widget">
                            <div class="circle-bar circle-bar1">
                                <div class="circle-graph1" data-percent="{{ $progressPercent }}">
                                    <div class="progress-less">
                                        <b>{{ $completedLessons }}/{{ $totalLessons }}</b>
                                        <p>Bài giảng đã hoàn thành</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Hoạt động giảng dạy</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Giáo viên</li>
                                        <li><span class="circle-green"></span>Học viên</li>
                                        <li class="star-menus"><a href="javascript:;"><i
                                                    class="fas fa-ellipsis-v"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="school-area"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-12 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title">Danh sách lịch trình</h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="teaching-card">
                                <ul class="steps-history">
                                    @foreach ($teachingDates as $date)
                                        <li>{{ $date->format('d/m') }}</li>
                                    @endforeach
                                </ul>
                                <ul class="activity-feed">
                                    @foreach ($teachingHistories as $history)
                                        <li class="feed-item d-flex align-items-center">
                                            <div class="dolor-activity">
                                                <span class="feed-text1"><a>{{ $history->course_title }}</a></span>
                                                <ul class="teacher-date-list">
                                                    <li><i
                                                            class="fas fa-calendar-alt me-2"></i>{{ $history->date->format('d/m/Y') }}
                                                    </li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>{{ $history->start_time }} -
                                                        {{ $history->end_time }} ({{ $history->duration }} phút)</li>
                                                </ul>
                                            </div>
                                            <div class="activity-btns ms-auto">
                                                <button type="submit"
                                                    class="btn btn-info">{{ $history->status }}</button>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card flex-fill comman-shadow">
                <div class="card-body">
                    <div id="calendar-doctor" class="calendar-container"></div>
                    <div class="calendar-info calendar-info1">
                        <div class="up-come-header">
                            <h2>Sự kiện sắp tới</h2>
                            <span><a href="javascript:;"><i class="feather-plus"></i></a></span>
                        </div>
                        <p>Số sự kiện: {{ count($upcomingSchedules) }}</p>
                        @foreach ($upcomingSchedules as $event)
                            <div class="upcome-event-date">
                                <h3>{{ \Carbon\Carbon::parse($event->start_time)->format('d M') }}</h3>

                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <h3>{{ \Carbon\Carbon::parse($event->start_time)->format('d M') }}</h3>

                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>{{ $event->course->title }}</h4>
                                        <h5>{{ $event->event }}</h5>
                                    </div>
                                    <span>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</span>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
