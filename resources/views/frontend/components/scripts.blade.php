<script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.js') }}"></script>
<script src="{{ asset('frontend/js/waypoint.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/fancybox.js') }}"></script>
<script src="{{ asset('frontend/js/datedropper.min.js') }}"></script>
<script src="{{ asset('frontend/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('frontend/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.lazy.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

<script>
    $(document).ready(function() {
        function fetchCourses() {
            let selectedCategories = $('input[name="categories[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            let selectedLevels = $('input[name="levels[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            let selectedTeachers = $('input[name="teachers[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: '{{ route('student.course.filter') }}', // Bạn cần tạo route này ở web.php
                method: 'GET',
                data: {
                    categories: selectedCategories,
                    levels: selectedLevels,
                    teachers: selectedTeachers,
                },
                success: function(response) {
                    $('#course-list').html(response.html);
                },
                error: function(err) {
                    console.error("Lỗi khi load khóa học:", err);
                }
            });
        }

        // Bắt sự kiện khi checkbox thay đổi
        $(document).on('change', '.filter-checkbox', function() {
            fetchCourses();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.contact-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('contact.submit') }}", // hoặc '/contact'
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    toastr.success('Gửi liên hệ thành công!');
                    $('.contact-form')[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Có lỗi xảy ra khi gửi liên hệ.');
                    }
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(".testimonial-carousel").owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            items: 2, // hoặc 1 nếu bạn muốn hiển thị từng cái
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filterForm');

        if (!form) {
            console.error('Không tìm thấy form với id filterForm');
            return;
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();
            const url = form.action + '?' + params;

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('course-list').innerHTML = html;
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let currentCourseId = null;
        let pollingInterval = null;

        function pollMessages(courseId) {
            if (pollingInterval) clearInterval(pollingInterval);
            pollingInterval = setInterval(function() {
                $.get('/chat/' + courseId + '/messages', function(response) {
                    let tempDiv = $('<div>').html(response.html);
                    let newBox = tempDiv.find('.conversation-box').html();
                    $('.conversation-box').html(newBox);
                    // Scroll xuống cuối mỗi lần cập nhật
                    const chatContainer = document.querySelector('.conversation-box');
                    if (chatContainer) {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                });
            }, 2000);
        }

        function loadMessages(courseId, scrollToBottom = true) {
            currentCourseId = courseId;
            $.get('/chat/' + courseId + '/messages', function(response) {
                $('#chat-box').html(response.html);
                if (scrollToBottom) {
                    const chatContainer = document.querySelector('.conversation-box');
                    if (chatContainer) {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                }
                pollMessages(courseId);
            });
        }

        $(document).on('click', '.chat-link', function(e) {
            e.preventDefault();
            loadMessages($(this).data('course-id'));
        });

        $(document).on('submit', '#chat-form', function(e) {
            e.preventDefault();
            let form = $(this);

            $.ajax({
                type: "POST",
                url: '/chat/' + currentCourseId + '/send',
                data: form.serialize() + '&course_id=' + currentCourseId,
                success: function() {
                    // Sau khi gửi, chỉ reload phần tin nhắn
                    $.get('/chat/' + currentCourseId + '/messages', function(response) {
                        let tempDiv = $('<div>').html(response.html);
                        let newBox = tempDiv.find('.conversation-box').html();
                        $('.conversation-box').html(newBox);
                        form[0].reset();
                        // Scroll xuống cuối
                        const chatContainer = document.querySelector(
                            '.conversation-box');
                        if (chatContainer) {
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                        }
                    });
                },
                error: function() {
                    alert('Lỗi khi gửi tin nhắn!');
                }
            });
        });
    });
</script>

<script>
    $(document).on('click', '.favorite-btn', function() {
        var btn = $(this);
        var courseId = btn.data('course-id');
        $.post('/courses/' + courseId + '/favorite', {
            _token: '{{ csrf_token() }}'
        }, function(res) {
            if (res.status === 'unauthenticated') {
                toastr.warning('Bạn cần đăng nhập để sử dụng chức năng này!');
            } else if (res.status === 'added') {
                btn.find('i').removeClass('la-heart-o').addClass('la-heart text-danger');
                toastr.success('Đã thêm vào khóa học yêu thích!');
            } else {
                btn.find('i').removeClass('la-heart text-danger').addClass('la-heart-o');
                toastr.info('Đã xóa khỏi khóa học yêu thích!');
            }
        });
    });
</script>

<script>
    function removeFromWishlist(courseId) {
        if (!confirm('Bạn có chắc muốn xóa khỏi danh sách yêu thích?')) return;
        $.ajax({
            url: '/courses/' + courseId + '/favorite',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.status === 'removed') {
                    // Ẩn card khóa học vừa xóa
                    $('#wishlist-course-' + courseId).remove();
                    toastr.success('Đã xóa khỏi danh sách yêu thích!');
                } else {
                    toastr.error('Có lỗi xảy ra!');
                }
            },
            error: function() {
                toastr.error('Có lỗi xảy ra!');
            }
        });
    }
</script>
