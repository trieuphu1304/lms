<header class="header-menu-area bg-white">
    <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray">
                                <i class="la la-phone mr-1"></i>
                                <a href="tel:00123456789"> 0869764432</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="la la-envelope-o mr-1"></i>
                                <a href="mailto:contact@aduca.com"> contact@aduca.com</a>
                            </li>
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->

                <div class="col-lg-6">
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">

                        <div class="theme-picker d-flex align-items-center">

                        </div>


                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-top -->

    <div class="header-menu-content pr-150px pl-150px bg-white">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="index.html" class="logo"><img src="{{ asset('frontend/images/logo.png') }}"
                                    alt="logo"></a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Tìm kiếm">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Danh mục">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Menu chính">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <div class="menu-category">
                                <ul>
                                    <li>
                                        <a style="margin-right:auto;" href="#">Danh mục <i
                                                class="la la-angle-down fs-12 "></i></a>
                                        <ul class="cat-dropdown-menu">
                                            <li>
                                                <a href="course-grid.html">Lập trình <i
                                                        class="la la-angle-right"></i></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#">Tất cả lập trình</a></li>
                                                    <li><a href="#">Lập trình Web</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="course-grid.html">Kinh doanh <i
                                                        class="la la-angle-right"></i></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#">Tất cả kinh doanh</a></li>
                                                    <li><a href="#">Tài chính</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- end menu-category -->
                            <form method="post">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search"
                                        placeholder="Tìm kiếm khóa học...">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <nav class="main-menu">
                                <ul>
                                    <li><a href="#">Trang chủ </a></li>
                                    <li><a href="#">Khóa học </a></li>
                                    <li><a href="#">Giới thiệu </a></li>
                                    <li><a href="#">Liên hệ </a></li>
                                    <li>
                                        <i class="la la-sign-in mr-1"></i>
                                        <a href="#"> Đăng nhập</a>
                                    </li>
                                    <li>
                                        <i class="la la-user mr-1"></i>
                                        <a href="#"> Đăng ký</a>
                                    </li>
                                </ul>
                            </nav><!-- end main-menu -->

                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->

    <!-- Các menu off-canvas -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip"
            data-placement="left" title="Đóng menu">
            <i class="la la-times"></i>
        </div>
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Khóa học</a></li>
            <li><a href="#">Học viên</a></li>
            <li><a href="#">Trang</a></li>
            <li><a href="#">Blog</a></li>
        </ul>
    </div>

    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip"
            data-placement="left" title="Đóng menu">
            <i class="la la-times"></i>
        </div>
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="course-grid.html">Lập trình</a>
                <ul class="sub-menu">
                    <li><a href="#">Tất cả lập trình</a></li>
                    <li><a href="#">Lập trình web</a></li>
                    <li><a href="#">Ứng dụng di động</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Kinh doanh</a>
                <ul class="sub-menu">
                    <li><a href="#">Tất cả kinh doanh</a></li>
                    <li><a href="#">Tài chính</a></li>
                    <li><a href="#">Khởi nghiệp</a></li>
                    <li><a href="#">Chiến lược</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-3" type="text" name="search"
                        placeholder="Tìm kiếm khóa học...">
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div>
        </div>
    </div>

    <div class="body-overlay"></div>

</header>
