<!doctype html>
<html lang="en">

<head>
    @include('backend.components.head')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('backend.components.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('backend.components.header')
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
        @include('backend.components.footer')
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    @include('backend.components.script')
</body>

</html>
