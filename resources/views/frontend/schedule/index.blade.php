<style>
    :root {
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --text-primary: #2d3748;
    }

    .schedule-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 60px 0;
        border-radius: 15px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .schedule-header h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .schedule-header p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
    }

    .filter-section label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-select {
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        padding: 12px 15px;
        transition: all 0.3s ease;
        font-size: 1rem;
        color: var(--text-primary);
    }

    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 3px solid #f0f0f0;
    }

    .section-title i {
        font-size: 1.8rem;
    }

    .section-title h3 {
        font-weight: 700;
        margin: 0;
        font-size: 1.5rem;
        flex-grow: 1;
    }

    .upcoming-section .section-title h3 {
        color: var(--success-color);
    }

    .completed-section .section-title h3 {
        color: black;
    }

    .section-title .badge {
        font-size: 0.9rem;
        padding: 6px 12px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 15px;
        margin-top: 30px;
    }

    .empty-state i {
        font-size: 5rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h5 {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 10px;
        font-size: 1.3rem;
    }

    .empty-state p {
        color: #666;
        margin: 0;
    }

    .schedules-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-top: 25px;
    }

    @media (max-width: 768px) {
        .schedules-grid {
            grid-template-columns: 1fr;
        }

        .schedule-header {
            padding: 40px 0;
        }

        .schedule-header h1 {
            font-size: 1.8rem;
        }
    }

    .section-container {
        margin-bottom: 50px;
    }

    .alert-custom {
        border-left: 4px solid;
        border-radius: 10px;
        padding: 20px;
        background-color: rgba(52, 211, 153, 0.1);
        border-color: #34d399;
    }

    .alert-custom i {
        margin-right: 10px;
        color: #34d399;
    }
</style>

<div class="container-fluid py-5">
    <!-- Header -->
    <div class="schedule-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1>
                        <i class="fas fa-calendar-alt"></i> Lịch Trình Học Tập
                    </h1>
                    <p class="mb-0">Quản lý tất cả lịch học của các khóa học bạn đã đăng ký</p>
                </div>
                <div class="col-lg-4 text-lg-end d-none d-lg-block">
                    <div style="font-size: 4rem; opacity: 0.25;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <label for="courseFilter">
                        <i class="fas fa-filter"></i> Lọc theo khóa học
                    </label>
                    <select class="form-select" id="courseFilter">
                        <option value="">-- Tất cả khóa học ({{ $enrolledCourses->count() }}) --</option>
                        @foreach ($enrolledCourses as $course)
                            <option value="{{ $course->id }}" {{ $courseId == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if ($schedules->isEmpty())
            <!-- Empty State -->
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h5>Không có lịch trình nào</h5>
                <p>Hãy đăng ký các khóa học để xem lịch học của giáo viên</p>
            </div>
        @else
            <!-- Upcoming Schedules Section -->
            @if ($upcomingSchedules->isNotEmpty())
                <div class="section-container upcoming-section">
                    <div class="section-title">
                        <i class="fas fa-hourglass-start"></i>
                        <h3>Lịch Sắp Tới</h3>
                        <span class="badge bg-success">{{ $upcomingSchedules->count() }} sự kiện</span>
                    </div>
                    <div class="schedules-grid">
                        @foreach ($upcomingSchedules as $schedule)
                            @include('frontend.schedule.card', ['schedule' => $schedule])
                        @endforeach
                    </div>
                </div>
            @else
                <div class="section-container upcoming-section">
                    <div class="section-title">
                        <i class="fas fa-hourglass-start"></i>
                        <h3>Lịch Sắp Tới</h3>
                    </div>
                    <div class="alert-custom">
                        <i class="fas fa-info-circle"></i> Không có lịch sắp tới
                    </div>
                </div>
            @endif

            <!-- Past Schedules Section -->
            @if ($pastSchedules->isNotEmpty())
                <div class="section-container completed-section">
                    <div class="section-title">
                        <i class="fas fa-check-circle"></i>
                        <h3>Lịch Đã Hoàn Thành</h3>
                        <span>{{ $pastSchedules->count() }} sự kiện</span>
                    </div>
                    <div class="schedules-grid">
                        @foreach ($pastSchedules as $schedule)
                            @include('frontend.schedule.card', ['schedule' => $schedule])
                        @endforeach
                    </div>
                </div>
            @else
                <div class="section-container completed-section">
                    <div class="section-title">
                        <i class="fas fa-check-circle"></i>
                        <h3>Lịch Đã Hoàn Thành</h3>
                    </div>
                    <div class="alert-custom"
                        style="background-color: rgba(107, 114, 128, 0.1); border-color: #6b7280;">
                        <i class="fas fa-info-circle" style="color: #6b7280;"></i> Không có lịch đã hoàn thành
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<script>
    document.getElementById('courseFilter').addEventListener('change', function() {
        const courseId = this.value;
        if (courseId) {
            window.location.href = `{{ route('student.schedules') }}?course_id=${courseId}`;
        } else {
            window.location.href = `{{ route('student.schedules') }}`;
        }
    });
</script>
