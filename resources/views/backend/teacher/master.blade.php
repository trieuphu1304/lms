<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.teacher.components.head')
</head>

<body>

    <div class="main-wrapper">

        @include('backend.teacher.components.header')

        @include('backend.teacher.components.sidebar')

        <div class="page-wrapper">
            @include($template)

            @include('backend.teacher.components.footer')

        </div>

    </div>

    @include('backend.teacher.components.scripts')
</body>

</html>
