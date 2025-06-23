<div class="page-content">
    <div class="container">
        <h2 class="mb-4">Chi tiết kết quả - {{ $result->student->name ?? 'Học viên' }}</h2>
        <div class="row mb-4">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Học viên:</strong> {{ $result->student->name ?? '---' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> {{ $result->student->email ?? '---' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Bài kiểm tra:</strong> {{ $result->quiz->title ?? '---' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Điểm số:</strong> <span class="badge bg-success fs-5">{{ $result->score }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Số câu hỏi:</strong> {{ $result->total_questions }}
                    </li>
                    <li class="list-group-item">
                        <strong>Số câu đúng:</strong> {{ $result->correct_answers }}
                    </li>
                    <li class="list-group-item">
                        <strong>Thời gian nộp bài:</strong>
                        {{ $result->submitted_at ? \Carbon\Carbon::parse($result->submitted_at)->format('d/m/Y H:i') : '---' }}
                    </li>
                </ul>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Thông số điểm</h6>
                            </div>
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
                        <div class="chart-container-1 mt-3">
                            <canvas id="chart4" width="300" height="200"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                            Số câu đúng
                            <span class="badge bg-gradient-quepal rounded-pill">
                                {{ $result->correct_answers }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Số câu sai
                            <span class="badge bg-gradient-ibiza rounded-pill">
                                {{ $result->total_questions - $result->correct_answers }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.quiz_result', $result->quiz_id) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Quay lại danh sách kết quả
        </a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('chart4').getContext('2d');
            var correct = {{ $result->correct_answers }};
            var incorrect = {{ $result->total_questions - $result->correct_answers }};
            new Chart(ctx, {
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
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endpush
