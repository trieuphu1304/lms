@foreach ($reviews as $review)
    <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
        <div class="media-img mr-4 rounded-full">
            <img class="rounded-full lazy" src="{{ asset('images/default-avatar.png') }}" alt="User image">
        </div>
        <div class="media-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                <h5>{{ $review->name }}</h5>
                <div class="review-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="la la-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></span>
                    @endfor
                </div>
            </div>
            <span class="d-block lh-18 pb-2">{{ $review->created_at->diffForHumans() }}</span>
            <p class="pb-2">{{ $review->message }}</p>
        </div>
    </div>
@endforeach
