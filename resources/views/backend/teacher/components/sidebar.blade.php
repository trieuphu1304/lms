<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Menu chính</span></li>

                <li class="submenu active">
                    <a href="#"><i class="feather-grid"></i> <span>Trang chủ</span> </a>

                </li>

                <li>
                    <a href="{{ route('teacher.students') }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span> Quản lí học viên</span>
                    </a>
                </li>


                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard-list"></i><span>Quản lí khóa học</span> <span
                            class="menu-arrow"></a>
                    <ul>
                        <li><a href="{{ route('teacher.course') }}">Khóa học</a></li>

                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i><span> Quản lí bài nộp</span> </a>

                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i><span> Phản hồi</span> </a>

                </li>
            </ul>

        </div>
    </div>
</div>
