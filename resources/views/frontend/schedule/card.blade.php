<style>
    .schedule-card {
        border: none !important;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .schedule-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.25);
    }

    .schedule-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 18px;
        color: white;
        flex-shrink: 0;
    }

    .schedule-card .card-header h6 {
        margin: 0;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .schedule-card .card-body {
        flex-grow: 1;
        padding: 20px;
    }

    .schedule-card .card-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #2d3748;
        margin-bottom: 16px;
    }

    .schedule-meta {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f0f0f0;
    }

    .schedule-meta small {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 0.9rem;
    }

    .schedule-meta i {
        width: 18px;
        text-align: center;
        color: #667eea;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        margin-bottom: 16px;
    }

    .status-badge.waiting {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-badge.completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-badge.cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .link-section {
        margin-bottom: 12px;
    }

    .link-section small {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .link-section i {
        color: #667eea;
    }

    .btn-access {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: #667eea;
        border-color: #667eea;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-access:hover {
        background-color: #764ba2;
        border-color: #764ba2;
        color: white;
        transform: translateX(2px);
    }

    .no-link-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #999;
        font-size: 0.9rem;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 6px;
    }

    .recurrence-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #667eea;
        font-size: 0.9rem;
        font-weight: 500;
        padding-top: 12px;
    }

    .recurrence-info i {
        font-size: 1rem;
    }
</style>

<div class="card h-100 schedule-card">
    <div class="card-header">
        <h6>
            <i class="fas fa-book"></i> {{ $schedule->course->title }}
        </h6>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $schedule->event }}</h5>

        <div class="schedule-meta">
            <small>
                <i class="fas fa-calendar"></i>
                <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('d/m/Y') }}</span>
            </small>
            <small>
                <i class="fas fa-clock"></i>
                <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</span>
            </small>
        </div>

        <!-- Status Badge -->
        <div>
            @php
                $statusClass = match ($schedule->status) {
                    'Đang chờ' => 'waiting',
                    'Đã hoàn thành' => 'completed',
                    'Đã hủy' => 'cancelled',
                    default => 'waiting',
                };
                $statusIcon = match ($schedule->status) {
                    'Đang chờ' => 'fa-hourglass-half',
                    'Đã hoàn thành' => 'fa-check-circle',
                    'Đã hủy' => 'fa-times-circle',
                    default => 'fa-circle',
                };
            @endphp
            <span class="status-badge {{ $statusClass }}">
                <i class="fas {{ $statusIcon }}"></i> {{ $schedule->status }}
            </span>
        </div>

        <!-- Location/Link -->
        @if ($schedule->location)
            <div class="link-section">
                <small>
                    <i class="fas fa-video"></i> Link lớp học
                </small>
                <a href="{{ $schedule->location }}" target="_blank" class="btn-access">
                    <i class="fas fa-external-link-alt"></i> Truy cập
                </a>
            </div>
        @else
            <div class="no-link-info">
                <i class="fas fa-info-circle"></i>
                <span>Chưa cập nhật link lớp học</span>
            </div>
        @endif

        <!-- Recurrence -->
        @if ($schedule->recurrence && $schedule->recurrence !== '')
            <div class="recurrence-info">
                <i class="fas fa-sync-alt"></i>
                <span>Lặp lại: <strong>{{ $schedule->recurrence }}</strong></span>
            </div>
        @endif
    </div>
</div>
