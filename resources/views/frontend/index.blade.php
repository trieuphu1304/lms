<section class="hero-area">
    @include('frontend.components_index.hero_area')
</section>
<!--================================
        END HERO AREA
=================================-->

<!--======================================
        START FEATURE AREA
 ======================================-->
<section class="feature-area pb-90px">
    @include('frontend.components_index.feature_area')
</section>
<!--======================================
       END FEATURE AREA
======================================-->

<!--======================================
        START CATEGORY AREA
======================================-->

<section class="category-area pb-90px">
    @include('frontend.components_index.category_area')
</section><!-- end category-area -->
<!--======================================
        END CATEGORY AREA
======================================-->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area pb-120px">
    @include('frontend.components_index.course_area', [
        'categories' => $categories,
        'courses' => $courses,
        'categoryId' => $categoryId,
    ])
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->

<!-- ================================
       START FUNFACT AREA
================================= -->
<section class="funfact-area text-center overflow-hidden pt-20px pb-80px dot-bg">
    @include('frontend.components_index.funfact_area')
</section><!-- end funfact-area -->
<!-- ================================
       START FUNFACT AREA
================================= -->

<!--======================================
        START CTA AREA
======================================-->
<section class="cat-area pt-80px pb-80px bg-gray position-relative">
    @include('frontend.components_index.cta_area')
</section><!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->

<!--================================
         START TESTIMONIAL AREA
=================================-->
<section class="testimonial-area section-padding">
    @include('frontend.components_index.testimonial_area')
</section><!-- end testimonial-area -->
<!--================================
        END TESTIMONIAL AREA
=================================-->

<div class="section-block"></div>

<!--======================================
        START ABOUT AREA
======================================-->
<section class="about-area section--padding overflow-hidden">
    @include('frontend.components_index.about_area')
</section><!-- end about-area -->
<!--======================================
        END ABOUT AREA
======================================-->

<div class="section-block"></div>

<!--======================================
        START REGISTER AREA
======================================-->
<section class="register-area section-padding dot-bg overflow-hidden">
    @include('frontend.components_index.register_area')
</section><!-- end register-area -->
<!--======================================
        END REGISTER AREA
======================================-->

<div class="section-block"></div>

<!-- ================================
       START CLIENT-LOGO AREA
================================= -->
<section class="client-logo-area section-padding position-relative overflow-hidden text-center">
    @include('frontend.components_index.client_logo_area')
</section><!-- end client-logo-area -->
<!-- ================================
       START CLIENT-LOGO AREA
================================= -->

<!-- ================================
       START BLOG AREA
================================= -->
<section class="blog-area section--padding bg-gray overflow-hidden">
    @include('frontend.components_index.blog_area')
</section><!-- end blog-area -->
<!-- ================================
       START BLOG AREA
================================= -->

<!--======================================
        START GET STARTED AREA
======================================-->
<section class="get-started-area pt-30px pb-90px position-relative">
    @include('frontend.components_index.get_started_area')
</section><!-- end get-started-area -->
<!-- ================================
       START GET STARTED AREA
================================= -->

<!--======================================
        START SUBSCRIBER AREA
======================================-->
<section class="subscriber-area pt-60px pb-60px bg-gray position-relative overflow-hidden">
    @include('frontend.components_index.subscriber_area')
</section><!-- end subscriber-area -->
<!--======================================
        END SUBSCRIBER AREA
======================================-->
