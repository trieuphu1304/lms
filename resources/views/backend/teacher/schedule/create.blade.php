<div class="content container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title text-primary mb-0">
            {{ isset($schedule) ? 'Chỉnh sửa lịch trình' : 'Tạo lịch trình mới' }}
        </h3>

    </div>

    <div class="card border-primary shadow">
        <div class="card-body">
            <form method="POST"
                action="{{ isset($schedule) ? route('teacher.schedule.update', $schedule->id) : route('teacher.schedule.store') }}">
                @csrf
                @if (isset($schedule))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="course_id" class="form-label">Khóa học</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Chọn khóa học --</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" @selected(old('course_id', $schedule->course_id ?? '') == $course->id)>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="event" class="form-label">Tên lịch trình</label>
                    <input type="text" name="event" class="form-control"
                        value="{{ old('event', $schedule->event ?? '') }}" required>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="start_time" class="form-label">Thời gian bắt đầu</label>
                        <input type="datetime-local" name="start_time" class="form-control"
                            value="{{ old('start_time', isset($schedule) ? \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i') : '') }}"
                            required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="end_time" class="form-label">Thời gian kết thúc</label>
                        <input type="datetime-local" name="end_time" class="form-control"
                            value="{{ old('end_time', isset($schedule) ? \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i') : '') }}"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Link lớp học (Zoom/Google Meet...)</label>
                    <input type="text" name="location" class="form-control"
                        placeholder="Nhập link lớp học, ví dụ: https://zoom.us/j/123456789"
                        value="{{ old('location', $schedule->location ?? '') }}">
                    <small class="text-muted">Nhập link Zoom, Google Meet hoặc nền tảng lớp học bạn sử dụng</small>
                </div>


                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="Đang chờ" @selected(old('status', $schedule->status ?? '') == 'Đang chờ')>Đang chờ</option>
                        <option value="Đã hoàn thành" @selected(old('status', $schedule->status ?? '') == 'Đã hoàn thành')>Đã hoàn thành</option>
                        <option value="Đã hủy" @selected(old('status', $schedule->status ?? '') == 'Đã hủy')>Đã hủy</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="recurrence" class="form-label">Lặp lại</label>
                    <select name="recurrence" id="recurrence-select" class="form-select">
                        <option value="" @selected(old('recurrence', $schedule->recurrence ?? '') == '')>Không lặp</option>
                        <option value="Hàng ngày" @selected(old('recurrence', $schedule->recurrence ?? '') == 'Hàng ngày')>Hàng ngày</option>
                        <option value="Hàng tuần" @selected(old('recurrence', $schedule->recurrence ?? '') == 'Hàng tuần')>Hàng tuần</option>
                        <option value="Hàng tháng" @selected(old('recurrence', $schedule->recurrence ?? '') == 'Hàng tháng')>Hàng tháng</option>
                        <option value="Tùy chỉnh" @selected(!in_array(old('recurrence', $schedule->recurrence ?? ''), ['Hàng ngày', 'Hàng tuần', 'Hàng tháng', '']))>Tùy chỉnh</option>
                    </select>

                    {{-- Ô nhập khi chọn tùy chỉnh --}}
                    <div id="custom-recurrence" class="mt-2" style="display: none;">
                        <input type="text" name="custom_recurrence" class="form-control"
                            value="{{ in_array(old('recurrence', $schedule->recurrence ?? ''), ['Hàng ngày', 'Hàng tuần', 'Hàng tháng', '']) ? '' : old('recurrence', $schedule->recurrence ?? '') }}"
                            placeholder="Nhập kiểu lặp lại ví dụ: mỗi thứ 2, cuối tháng...">
                    </div>
                </div>


                <div class="text-end">
                    <a href="{{ route('teacher.schedule') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> Quay lại danh sách
                    </a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>


            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const recurrenceSelect = document.getElementById('recurrence-select');
        const customRecurrenceInput = document.getElementById('custom-recurrence');

        function toggleCustomInput() {
            if (recurrenceSelect.value === 'Tùy chỉnh') {
                customRecurrenceInput.style.display = 'block';
            } else {
                customRecurrenceInput.style.display = 'none';
            }
        }

        recurrenceSelect.addEventListener('change', toggleCustomInput);

        // Hiển thị lại nếu reload và "Tùy chỉnh" đã được chọn
        toggleCustomInput();
    });
</script>
