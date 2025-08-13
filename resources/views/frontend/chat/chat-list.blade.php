<div class="dashboard-content-wrap">
    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar khóa học bên trái --}}
            <div class="col-md-4 message-sidebar">
                <form action="#" class="p-4">
                    <div class="form-group mb-0">
                        <input class="form-control form--control form--control-gray pl-3" type="text"
                            placeholder="Search...">
                        <button type="submit" class="search-icon"><i class="la la-search"></i></button>
                    </div>
                </form>

                <div class="message-inbox-item border-bottom border-bottom-gray">
                    <div class="notification-body scrolled-box scrolled--box custom-scrollbar-styled">
                        @foreach ($enrolledCourses as $course)
                            <a href="#" class="media media-card align-items-center chat-link"
                                data-course-id="{{ $course->id }}">
                                <div class="avatar-sm flex-shrink-0 mr-2 position-relative">
                                    <img class="rounded-full img-fluid"
                                        src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                                        alt="Avatar image">
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h5 class="fs-14">{{ $course->title }}</h5>
                                    <p class="text-truncate lh-18 pt-1 text-gray fs-13">Click để chat với giáo viên</p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div><!-- end message-inbox-item -->
            </div>

            {{-- Khung chat bên phải --}}
            {{-- Khung chat bên phải --}}
            <div class="col-md-8 p-4" style="border-left: 1px solid #eee; min-height: 600px;">
                <div id="chat-box">
                    <div class="text-center text-muted mt-5">
                        <h5>Chọn một khóa học để bắt đầu trò chuyện với giáo viên.</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
