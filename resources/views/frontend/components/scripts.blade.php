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
