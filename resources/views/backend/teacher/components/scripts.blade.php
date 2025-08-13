<script src="{{ asset('backend/teacher/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/js/feather.min.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/teacher/assets/plugins/apexchart/chart-data.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
<script src="{{ asset('backend/teacher/assets/js/calander.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/js/circle-progress.min.js') }}"></script>

<script src="{{ asset('backend/teacher/assets/js/script.js') }}"></script>

<script>
    $(document).on('click', '.course-link', function(e) {
        e.preventDefault();
        let courseId = $(this).data('id');
        $('#chat-box-right').html('<div class="text-center mt-5 text-muted">Chọn học viên để chat</div>');

        $.get(`/teacher/chat/students/${courseId}`, function(data) {
            $('#student-list').html(data);
        });
    });

    $(document).on('click', '.student-link', function(e) {
        e.preventDefault();
        let courseId = $(this).data('course-id');
        let studentId = $(this).data('id');


    });

    $(document).on('submit', '#chat-form', function(e) {
        e.preventDefault();
        let form = $(this);

        $.post(form.attr('action'), form.serialize(), function() {
            form.find('input[name="message"]').val('');

            let courseId = form.find('input[name="course_id"]').val();
            let studentId = form.find('input[name="receiver_id"]').val();

            $.get(`/teacher/chat/messages/${courseId}/${studentId}`, function(data) {
                $('#chat-box-right').html(data);
                scrollToBottom();
            });

        });
    });

    function scrollToBottom() {
        let box = $('.conversation-box');
        box.scrollTop(box.prop('scrollHeight'));
    }

    function scrollChatSmooth() {
        let box = $('.conversation-box');
        if (box.length) {
            box.stop().animate({
                scrollTop: box.prop('scrollHeight')
            }, 300);
        }
    }


    let lastMessageCount = 0;
    let pollingInterval = null;

    function startPolling(courseId, studentId) {
        if (pollingInterval) clearInterval(pollingInterval);
        pollingInterval = setInterval(function() {
            $.get(`/teacher/chat/messages/${courseId}/${studentId}`, function(data) {
                // Lấy phần .conversation-box từ data
                let newBox = $('<div>').html(data).find('.conversation-box').html();
                let box = $('.conversation-box');
                let oldScroll = box.scrollTop();
                let oldCount = box.find('.conversation-item').length;

                box.html(newBox);

                // Chỉ scroll nếu có tin nhắn mới
                let newCount = box.find('.conversation-item').length;
                if (newCount > oldCount) {
                    scrollChatSmooth();
                } else {
                    box.scrollTop(oldScroll);
                }
            });
        }, 2000);
    }

    // Khi chọn học viên để chat, bắt đầu polling
    $(document).on('click', '.student-link', function(e) {
        e.preventDefault();
        let courseId = $(this).data('course-id');
        let studentId = $(this).data('id');
        $.get(`/teacher/chat/messages/${courseId}/${studentId}`, function(data) {
            $('#chat-box-right').html(data);
            scrollChatSmooth();
            lastMessageCount = $('.conversation-item').length;
            startPolling(courseId, studentId);
        });
    });

    // Khi gửi tin nhắn, polling vẫn tiếp tục như cũ
</script>
