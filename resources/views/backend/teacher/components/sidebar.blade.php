<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Menu chính</span></li>

                <li>
                    <a href="{{ route('teacher.dashboard') }}"><i class="feather-grid"></i> <span>Trang chủ</span> </a>

                </li>

                <li>
                    <a href="{{ route('teacher.students') }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span> Quản lí học viên</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.categories.index') }}">
                        <i class="fas fa-book-reader"></i>
                        <span> Quản lí danh mục</span>
                    </a>
                </li>


                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard-list"></i><span>Quản lí khóa học</span> <span
                            class="menu-arrow"></a>
                    <ul>
                        <li><a href="{{ route('teacher.course') }}">Khóa học</a></li>
                        <li><a href="{{ route('teacher.section') }}">Chương học</a></li>
                        <li><a href="{{ route('teacher.quiz_results.index') }}">Quản lí điểm học</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('teacher.feedback') }}">
                        <i class="fas fa-clipboard"></i>
                        <span> Quản lí đánh giá</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.schedule') }}">
                        <i class="fas fa-calendar-day"></i>
                        <span> Quản lí lịch trình</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.chat.index') }}">
                        <i class="fas fa-calendar-day"></i>
                        <span> Chat với học viên</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
