<div class="container">
    <div class="section-heading text-center">
        <h5 class="ribbon ribbon-lg mb-2">Đánh giá</h5>
        <h2 class="section__title">Đánh giá của học viên</h2>
        <span class="section-divider"></span>
    </div><!-- end section-heading -->
</div><!-- end container -->
<div class="container-fluid">
    <div class="testimonial-carousel owl-action-styled">
        <div class="card card-item">
            <div class="card-body">
                @foreach ($reviews as $review)
                    <div class="media media-card align-items-center pb-3">

                        <div class="media-img avatar-md">
                            <img src="{{ asset('frontend/images/small-avatar-1.jpg') }}" alt="Testimonial avatar"
                                class="rounded-full">
                        </div>
                        <div class="media-body">
                            <h5>{{ $review->student->name }}</h5>
                            <div class="d-flex align-items-center pt-1">
                                <span class="lh-18 pr-2">Học viên</span>
                                <div class="review-stars">
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                </div>
                            </div>
                        </div>

                    </div><!-- end media -->
                    <p class="card-text">
                        {{ $review->message }}
                    </p>
                @endforeach
            </div><!-- end card-body -->
        </div><!-- end card -->

    </div><!-- end testimonial-carousel -->
</div><!-- container-fluid -->
