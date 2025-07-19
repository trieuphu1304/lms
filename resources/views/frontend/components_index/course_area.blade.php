<div class="container">
    <div class="section-heading text-center">
        <h5 class="ribbon ribbon-lg mb-2">Chọn khóa học bạn mong muốn</h5>
        <h2 class="section__title">Kho khóa học trực tuyến </h2>
        <span class="section-divider"></span>
    </div>

    <ul class="nav nav-tabs generic-tab justify-content-center pb-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ empty($categoryId) ? 'active' : '' }} category-tab" href="#" data-category="">Tất
                cả</a>
        </li>
        @foreach ($categories as $category)
            <li class="nav-item">
                <a class="nav-link {{ isset($categoryId) && $categoryId == $category->id ? 'active' : '' }} category-tab"
                    href="#" data-category="{{ $category->id }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="card-content-wrapper bg-gray pt-50px pb-120px">
    <div class="container">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
                <div class="row" id="course-list">
                    @include('frontend.components_index.course_list', ['courses' => $courses])
                </div><!-- end row -->
            </div><!-- end tab-pane -->
        </div><!-- end tab-content -->
    </div><!-- end container -->
</div><!-- end course-wrapper -->
