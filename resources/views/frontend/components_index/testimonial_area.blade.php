<div class="container">
    <div class="section-heading text-center">
        <h5 class="ribbon ribbon-lg mb-2">Testimonials</h5>
        <h2 class="section__title">Student's Feedback</h2>
        <span class="section-divider"></span>
    </div><!-- end section-heading -->
</div><!-- end container -->
<div class="container-fluid">
    <div class="testimonial-carousel owl-action-styled owl-carousel">
        @foreach ($testimonials as $review)
            <div class="card card-item">
                <div class="card-body">
                    <div class="media media-card align-items-center pb-3">
                        <div class="media-img avatar-md">
                            <img src="{{ $review->student->avatar ? asset('storage/' . $review->student->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($review->student->name) }}"
                                alt="Avatar" class="rounded-full">

                        </div>
                        <div class="media-body">
                            <h5>{{ $review->name }}</h5>
                            <div class="d-flex align-items-center pt-1">
                                <span class="lh-18 pr-2">Học viên</span>
                                <div class="review-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="la {{ $i <= $review->rating ? 'la-star' : 'la-star-o' }}"></span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div><!-- end media -->
                    <p class="card-text">
                        {{ $review->message }}
                    </p>
                </div><!-- end card-body -->
            </div>
        @endforeach
    </div>
</div>
