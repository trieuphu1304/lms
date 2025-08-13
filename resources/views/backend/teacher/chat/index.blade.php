<div class="content container-fluid">
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            <div class="row">
                {{-- Sidebar khóa học bên trái --}}
                <div class="col-md-4 message-sidebar border-right">
                    <form action="#" class="p-4">
                        <div class="form-group mb-0 position-relative">
                            <input class="form-control form--control form--control-gray pl-3" type="text"
                                placeholder="Search...">
                            <button type="submit" class="search-icon"><i class="la la-search"></i></button>
                        </div>
                    </form>
                    <div class="message-inbox-item border-bottom border-bottom-gray">
                        <div class="notification-body scrolled-box scrolled--box custom-scrollbar-styled">
                            @foreach ($courses as $course)
                                <a href="#" class="media media-card align-items-center course-link p-2"
                                    data-id="{{ $course->id }}">
                                    <div class="avatar-sm flex-shrink-0 mr-2 position-relative">
                                        <img class="rounded-full img-fluid"
                                            src="{{ $course->avatar ? asset('storage/' . $course->avatar) : asset('frontend/images/img8.jpg') }}"
                                            alt="Avatar image">
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h5 class="fs-14 mb-0">{{ $course->title }}</h5>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- Cột giữa: Danh sách học viên --}}
                <div class="col-md-4 message-sidebar border-right" id="student-list">
                    <div class="message-inbox-item border-bottom border-bottom-gray">
                        <div class="notification-body scrolled-box scrolled--box custom-scrollbar-styled">
                            <div class="text-center text-muted" style="margin-top: 4.5rem;">
                                <h5>Chọn khóa học</h5>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cột phải: Khung chat --}}
                <div class="col-md-4 p-4" style="min-height: 600px;" id="chat-box-right">
                    <div class="text-center text-muted mt-5">
                        <h5>Chọn học viên chat</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
