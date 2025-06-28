<!doctype html>
<html lang="en">

<head>
    @include('backend.admin.components.head')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('backend.admin.components.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('backend.admin.components.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @include($template)
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('backend.admin.components.footer')
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    @include('backend.admin.components.script')
</body>

</html>
