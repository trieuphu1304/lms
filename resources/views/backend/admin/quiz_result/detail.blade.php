<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Chi tiết kết quả - {{ $result->student->name ?? 'Học viên' }}</h2>
        <div class="row mb-4">
            {{-- Card Thông tin điểm --}}
            <div class="col-12 mb-4">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent border-bottom pb-0">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">Thông tin điểm</h6>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Xuất PDF</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Xuất Excel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row text-center mb-0">
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Học viên</div>
                                <div>{{ $result->student->name ?? '---' }}</div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Email</div>
                                <div>{{ $result->student->email ?? '---' }}</div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Bài kiểm tra</div>
                                <div>{{ $result->quiz->title ?? '---' }}</div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Điểm số</div>
                                <span class="badge bg-success fs-6">{{ $result->score }}</span>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Số câu hỏi</div>
                                <div>{{ $result->total_questions }}</div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Số câu đúng</div>
                                <div>{{ $result->correct_answers }}</div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="fw-semibold">Thời gian nộp bài</div>
                                <div>
                                    {{ $result->submitted_at ? \Carbon\Carbon::parse($result->submitted_at)->format('d/m/Y H:i') : '---' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Card Biểu đồ Tỉ lệ đúng/sai --}}
            <div class="col-12 col-md-6 mb-4">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent border-bottom pb-0">
                        <h6 class="mb-0">Tỉ lệ đúng/sai</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="w-100" style="max-width:350px;">
                            <canvas id="chartCorrectWrong"></canvas>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success me-2 fs-6">Đúng: {{ $result->correct_answers }}</span>
                            <span class="badge bg-danger fs-6">Sai:
                                {{ $result->total_questions - $result->correct_answers }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Card Biểu đồ So sánh điểm --}}
            <div class="col-12 col-md-6 mb-4">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent border-bottom pb-0">
                        <h6 class="mb-0">So sánh điểm</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="w-100" style="max-width:350px;">
                            <canvas id="chartScoreCompare"></canvas>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success me-2 fs-6">Học viên: {{ $result->score }}</span>
                            <span class="badge bg-primary fs-6">TB lớp: {{ round($classAvgScore, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.quiz_result', $result->quiz_id) }}" class="btn btn-secondary mt-3">
                <i class="bx bx-arrow-back"></i> Quay lại danh sách kết quả
            </a>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Biểu đồ tròn đúng/sai
                var ctx1 = document.getElementById('chartCorrectWrong').getContext('2d');
                var correct = {{ $result->correct_answers }};
                var incorrect = {{ $result->total_questions - $result->correct_answers }};
                new Chart(ctx1, {
                    type: 'doughnut',
                    data: {
                        labels: ['Đúng', 'Sai'],
                        datasets: [{
                            data: [correct, incorrect],
                            backgroundColor: ['#28a745', '#dc3545'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        cutout: '70%',
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // Biểu đồ cột so sánh điểm
                var ctx2 = document.getElementById('chartScoreCompare').getContext('2d');
                var studentScore = {{ $result->score }};
                var classAvg = {{ round($classAvgScore, 2) }};
                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: ['Học viên', 'Trung bình lớp'],
                        datasets: [{
                            label: 'Điểm số',
                            data: [studentScore, classAvg],
                            backgroundColor: ['#28a745', '#007bff']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</div>

<style>
    @media (max-width: 767.98px) {
        .card-body .row>div {
            align-items: stretch !important;
        }
    }

    canvas {
        width: 100% !important;
        height: auto !important;
        max-height: 350px;
    }
</style>
