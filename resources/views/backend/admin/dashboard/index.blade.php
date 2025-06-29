<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng học sinh</p>
                            <h4 class="my-1 text-primary">{{ $totalStudents }}</h4>
                            <p class="mb-0 font-13">Tăng so với tuần trước</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class="bx bxs-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng giáo viên</p>
                            <h4 class="my-1 text-success">{{ $totalTeachers }}</h4>
                            <p class="mb-0 font-13">Ổn định trong tháng</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                class="bx bxs-chalkboard"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng khóa học</p>
                            <h4 class="my-1 text-info">{{ $totalCourses }}</h4>
                            <p class="mb-0 font-13">Đang hoạt động</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class="bx bxs-book"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng bài kiểm tra</p>
                            <h4 class="my-1 text-warning">{{ $totalQuizzes }}</h4>
                            <p class="mb-0 font-13">Tăng 12% so với tuần trước</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                class="bx bxs-edit-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <!-- Biểu đồ Học viên & Lượt học -->
        <div class="col-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Hoạt động học tập theo tháng</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Xem chi tiết</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                        <span class="border px-1 rounded cursor-pointer">
                            <i class="bx bxs-circle me-1" style="color: #14abef"></i>Học viên mới
                        </span>
                        <span class="border px-1 rounded cursor-pointer">
                            <i class="bx bxs-circle me-1" style="color: #ffc107"></i>Lượt học
                        </span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart1" width="1333" height="390"
                            style="display: block; box-sizing: border-box; height: 260px; width: 888px;"></canvas>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">12.5K</h5>
                            <small class="mb-0">Tổng Học Viên <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                                    3.2%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">08:15</h5>
                            <small class="mb-0">Thời gian học trung bình <span> <i
                                        class="bx bx-up-arrow-alt align-middle"></i> 10.6%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">120</h5>
                            <small class="mb-0">Lượt học/ngày <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                                    6.4%</span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ Khóa học phổ biến -->
        <div class="col-12 col-lg-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Khóa học phổ biến</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Top 10 theo tháng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-2">
                        <canvas id="chart2" width="624" height="330"
                            style="display: block; box-sizing: border-box; height: 220px; width: 416px;"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li
                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                        Lập trình Laravel <span class="badge bg-success rounded-pill">45</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Tiếng Anh giao tiếp <span class="badge bg-danger rounded-pill">30</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Toán 12 <span class="badge bg-primary rounded-pill">60</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Thiết kế Canva <span class="badge bg-warning text-dark rounded-pill">20</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>



</div>
