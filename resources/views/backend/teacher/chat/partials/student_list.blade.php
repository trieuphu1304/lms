<div class="message-header bg-gray d-flex align-items-center justify-content-between p-3 border-bottom">
    <div class="media media-card align-items-center flex-column">
        <div class="mb-1">
            Danh sách học viên
        </div>
        <div class="media-body">
            <h5 class="fs-14 mb-0">{{ $course->title }}</h5>
        </div>
    </div>

</div>
<div class="conversation-wrap">
    <div class="conversation-list custom-scrollbar-styled p-3" style="height: 450px; overflow-y: scroll;">
        @foreach ($students as $student)
            <a href="#" class="student-link d-flex align-items-center p-2 border-bottom"
                data-id="{{ $student->id }}" data-course-id="{{ $course->id }}">
                <img src="{{ $student->avatar ? asset('storage/' . $student->avatar) : asset('frontend/images/user.png') }}"
                    class="rounded-circle mr-2" width="40">
                <span>{{ $student->name }}</span>
            </a>
        @endforeach

    </div>
</div>
