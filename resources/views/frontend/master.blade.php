<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.components.head')
</head>

<body>
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    @include('frontend.components.header')

    @include($template)


    @include('frontend.components.footer')


    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-tab').forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Xóa active cũ
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove(
                        'active'));
                    this.classList.add('active');
                    let categoryId = this.getAttribute('data-category');
                    fetch(`{{ route('ajax.courses') }}?category_id=${categoryId ? categoryId : ''}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('course-list').innerHTML = html;
                        });
                });
            });
        });
    </script>

    @include('frontend.components.scripts')
</body>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    // Cấu hình góc hiển thị bên phải
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "2500"
    };
</script>

</html>
