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


    @include('frontend.components.scripts')
</body>

</html>
