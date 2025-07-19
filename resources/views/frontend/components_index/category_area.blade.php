<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-9">
            <div class="category-content-wrap">
                <div class="section-heading">
                    <h5 class="ribbon ribbon-lg mb-2">Danh mục</h5>
                    <h2 class="section__title">Danh mục phổ biến</h2>
                    <span class="section-divider"></span>
                </div><!-- end section-heading -->
            </div>
        </div><!-- end col-lg-9 -->
        <div class="col-lg-3">
            <div class="category-btn-box text-right">
                <a href="categories.html" class="btn theme-btn">Tất cả <i class="la la-arrow-right icon ml-1"></i></a>
            </div><!-- end category-btn-box-->
        </div><!-- end col-lg-3 -->
    </div><!-- end row -->
    <div class="category-wrapper mt-30px">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-4 responsive-column-half">
                    <div class="category-item">
                        <img class="cat__img lazy" src="{{ asset('frontend/images/img-loading.png') }}"
                            data-src="{{ $category->avatar ? asset('storage/' . $category->avatar) : asset('frontend/images/img1.jpg') }}">
                        <div class="category-content">
                            <div class="category-inner">
                                <h3 class="cat__title"><a href="#">{{ $category->name }}</a></h3>
                                <p class="cat__meta">{{ $category->courses_count ?? 0 }} courses</p>
                                <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Khám phá<i
                                        class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
