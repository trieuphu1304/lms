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
                            <h6>Total Classes</h6>
                            <h3>04/06</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/teacher-icon-01.svg') }}"
                                alt="Dashboard Icon">
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
                            <h6>Total Students</h6>
                            <h3>40/60</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/dash-icon-01.svg') }}"
                                alt="Dashboard Icon">
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
                            <h6>Total Lessons</h6>
                            <h3>30/50</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/teacher-icon-02.svg') }}"
                                alt="Dashboard Icon">
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
                            <h6>Total Hours</h6>
                            <h3>15/20</h3>
                        </div>
                        <div class="db-icon">
                            <img src="{{ asset('backend/teacher/assets/img/icons/teacher-icon-03.svg') }}"
                                alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
