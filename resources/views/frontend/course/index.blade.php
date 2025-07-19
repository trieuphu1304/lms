@php
    $level_vi = [
        'beginner' => 'Cơ bản',
        'intermediate' => 'Trung cấp',
        'advanced' => 'Nâng cao',
    ];
    $level_class = [
        'beginner' => 'level-basic',
        'intermediate' => 'level-intermediate',
        'advanced' => 'level-advanced',
    ];
@endphp
<style>
    .custom-control-label::before,
    .custom-control-label::after {
        display: none !important;
        content: none !important;
    }
</style>
<section class="course-area section-padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-14">Chúng tôi có <span class="text-black">{{ $totalCourses }}</span> khóa học cho bạn!</p>
                <div class="d-flex flex-wrap align-items-center">
                    <ul class="filter-nav mr-3">
                        <li><a href="course-grid.html" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="Grid View"><span class="la la-th-large"></span></a></li>
                        <li><a href="course-list.html" data-toggle="tooltip" data-placement="top" title=""
                                class="active" data-original-title="List View"><span class="la la-list"></span></a></li>
                    </ul>

                    <a class="btn theme-btn theme-btn-sm theme-btn-white lh-28 collapse-btn" data-toggle="collapse"
                        href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
                        Sắp xếp <i class="la la-angle-down ml-1 collapse-btn-hide"></i>
                        <i class="la la-angle-up ml-1 collapse-btn-show"></i>
                    </a>
                </div>
            </div><!-- end filter-bar-inner -->
            <div class="collapse pt-4" id="collapseFilter">
                <form id="filterForm" method="GET" action="{{ route('courses.index') }}">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">Danh mục</h3>

                                {{-- Hiển thị 4 danh mục đầu --}}
                                @foreach ($categories->take(4) as $category)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="filter-checkbox" name="categories[]"
                                            value="{{ $category->id }}" id="catCheckbox{{ $category->id }}"
                                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>

                                        <label class="custom-control-label text-black"
                                            for="catCheckbox{{ $category->id }}">
                                            {{ $category->name }} <span
                                                class="ml-1 text-gray">({{ $category->courses_count }})</span>
                                        </label>
                                    </div>
                                @endforeach


                                {{-- Danh mục ẩn trong collapse --}}
                                @if ($categories->count() > 4)
                                    <div class="collapse" id="collapseMoreCategories">
                                        @foreach ($categories->slice(4) as $category)
                                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                                <input type="checkbox" class="filter-checkbox" name="categories[]"
                                                    value="{{ $category->id }}"
                                                    {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>

                                                <label class="custom-control-label custom--control-label text-black"
                                                    for="catCheckbox{{ $category->id }}">
                                                    {{ $category->name }}
                                                    <span
                                                        class="ml-1 text-gray">({{ $category->courses_count }})</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Nút Show More / Show Less --}}
                                    <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse"
                                        href="#collapseMoreCategories" role="button" aria-expanded="false"
                                        aria-controls="collapseMoreCategories">
                                        <span class="collapse-btn-hide">Xem thêm <i
                                                class="la la-angle-down ml-1 fs-14"></i></span>
                                        <span class="collapse-btn-show">Thu gọn <i
                                                class="la la-angle-up ml-1 fs-14"></i></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">Cấp độ</h3>
                                @foreach ($level_vi as $key => $label)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="filter-checkbox" name="levels[]"
                                            value="{{ $key }}"
                                            {{ in_array($key, request('levels', [])) ? 'checked' : '' }}>

                                        <label class="custom-control-label custom--control-label text-black"
                                            for="levelCheckbox_{{ $key }}">
                                            {{ $label }}

                                        </label>
                                    </div>
                                @endforeach
                            </div><!-- end widget-panel -->
                        </div><!-- end col-lg-3 -->


                        <div class="col-lg-3">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">Giáo viên</h3>

                                @php
                                    $teachers = $courses
                                        ->filter(fn($course) => $course->teacher) // chỉ lấy khóa học có giáo viên
                                        ->pluck('teacher')
                                        ->unique('id')
                                        ->values(); // loại bỏ duplicate
                                @endphp

                                {{-- Hiển thị 4 giáo viên đầu --}}
                                @foreach ($teachers->take(4) as $teacher)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="filter-checkbox" name="teachers[]"
                                            value="{{ $teacher->id }}"
                                            {{ in_array($teacher->id, request('teachers', [])) ? 'checked' : '' }}>

                                        <label class="custom-control-label custom--control-label text-black"
                                            for="teacherCheckbox{{ $teacher->id }}">
                                            {{ $teacher->name }}
                                        </label>
                                    </div>
                                @endforeach

                                {{-- Danh sách giáo viên ẩn --}}
                                @if ($teachers->count() > 4)
                                    <div class="collapse" id="collapseMoreTeachers">
                                        @foreach ($teachers->slice(4) as $teacher)
                                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                                <input type="checkbox" class="filter-checkbox" name="teachers[]"
                                                    value="{{ $teacher->id }}"
                                                    {{ in_array($teacher->id, request('teachers', [])) ? 'checked' : '' }}
                                                    id="teacherCheckbox{{ $teacher->id }}">

                                                <label class="custom-control-label custom--control-label text-black"
                                                    for="teacherCheckbox{{ $teacher->id }}">
                                                    {{ $teacher->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Nút Xem thêm / Thu gọn --}}
                                    <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse"
                                        href="#collapseMoreTeachers" role="button" aria-expanded="false"
                                        aria-controls="collapseMoreTeachers">
                                        <span class="collapse-btn-hide">Xem thêm <i
                                                class="la la-angle-down ml-1 fs-14"></i></span>
                                        <span class="collapse-btn-show">Thu gọn <i
                                                class="la la-angle-up ml-1 fs-14"></i></span>
                                    </a>
                                @endif
                            </div>
                        </div>


                    </div><!-- end row -->
                </form>
            </div><!-- end collapse -->
        </div><!-- end filter-bar -->
        <div class="row" id="course-list">

            @include('frontend.course.components.course-list', ['course' => $courses])

        </div>

        <div class="text-center pt-3">
            <nav aria-label="Page navigation example" class="pagination-box">
                <div class="d-flex justify-content-center">
                    {{ $courses->links('pagination::bootstrap-4') }}

                </div>
                <p class="fs-14 pt-2">
                    Hiển thị {{ $courses->firstItem() }}-{{ $courses->lastItem() }} trong tổng số
                    {{ $courses->total() }} khóa học
                </p>

            </nav>

        </div>
    </div><!-- end container -->
</section>
