<section class="breadcrumb-area">
    <div class="bg-white py-3 pattern-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <ul class="quiz-nav d-flex flex-wrap align-items-center">
                    <li>
                        <a href="{{ route('lessons.show', $lesson->id) }}">
                            <i class="la la-arrow-left mr-2"></i>Quay lại bài giảng
                        </a>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.detail', $lesson->course->id) }}">
                                <img src="{{ $lesson->course->avatar ? asset('storage/' . $lesson->course->avatar) : asset('frontend/images/default-course.jpg') }}"
                                    alt="{{ $lesson->course->title }} thumbnail"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            </a>
                            <p class="mb-0 pl-2">
                                <a
                                    href="{{ route('course.detail', $lesson->course->id) }}">{{ $lesson->course->title }}</a>
                                <span class="d-block fs-13">{{ $lesson->course->teacher->name ?? 'Giáo viên' }}</span>
                            </p>
                        </div>
                    </li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </div>
    <div class="bg-dark pt-60px pb-60px">
        <div class="container">
            {{-- Thanh điều hướng các mục liên quan --}}
            <ul class="quiz-course-nav d-flex align-items-center justify-content-between">
                @foreach ($lesson->section->lessons as $item)
                    <li>
                        <a href="{{ route('lessons.show', $item->id) }}"
                            class="icon-element icon-element-sm {{ $item->id === $lesson->id ? 'text-success' : '' }}"
                            data-toggle="tooltip" data-placement="top" title="{{ $item->title }}">
                            <i class="la la-check"></i>
                        </a>
                    </li>
                @endforeach

                @if ($lesson->quiz)
                    <li>
                        <a href="{{ route('quiz.show', ['lesson' => $lesson->id]) }}"
                            class="icon-element icon-element-sm text-success" data-toggle="tooltip" data-placement="top"
                            title="Quiz: {{ $quiz->title }}">
                            <i class="la la-user"></i>
                        </a>
                    </li>
                @endif
            </ul>

            {{-- Nội dung câu hỏi --}}
            <div class="breadcrumb-content pt-40px">
                <div class="section-heading">
                    <h2 class="section__title text-white fs-30 pb-2">
                        Câu hỏi 1 trong {{ $questions->count() }}
                    </h2>
                    <p class="section__desc text-white-50">
                        {{ $questions[0]->question_text }}
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="quiz-action-nav bg-white py-3 shadow-sm">
        <div class="container">
            <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                <ul class="quiz-nav d-flex align-items-center">
                    <li>
                        <i class="la la-sliders fs-17 mr-2"></i>
                        Hãy chọn đáp án đúng bên dưới
                    </li>
                </ul>
                <div class="quiz-nav-btns">
                    {{-- Bỏ qua bài kiểm tra --}}
                    <a href="{{ route('lessons.show', $lesson->id) }}"
                        class="btn theme-btn theme-btn-transparent mr-2">
                        Bỏ qua
                    </a>

                    {{-- Xem lại video bài học --}}
                    <a href="{{ route('lessons.show', $lesson->id) }}"
                        class="btn theme-btn theme-btn-transparent mr-2">
                        Xem lại bài giảng
                    </a>


                </div>
            </div>
        </div>
    </div><!-- end quiz-action-nav -->

</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START QUIZ ANS AREA
================================= -->
<section class="quiz-ans-wrap pt-60px pb-60px">
    <div class="container">
        <form action="{{ route('quiz.submit', $lesson->id) }}" method="POST" id="quiz-form">
            @csrf

            @foreach ($questions as $index => $question)
                <div class="quiz-ans-content mb-4">
                    <h3 class="fs-20 font-weight-semi-bold">
                        Câu hỏi {{ $index + 1 }}: {{ $question->question_text }}
                    </h3>

                    <div class="quiz-ans-list py-3">
                        @foreach (['a', 'b', 'c', 'd'] as $option)
                            @php
                                $optionText = $question->{'option_' . $option};
                                $optionId = 'q' . $question->id . '_option_' . $option;
                            @endphp

                            @if ($optionText)
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" class="custom-control-input"
                                        name="answers[{{ $question->id }}]" id="{{ $optionId }}"
                                        value="{{ $option }}" required>
                                    <label class="custom-control-label custom--control-label"
                                        for="{{ $optionId }}">
                                        {{ strtoupper($option) }}. {{ $optionText }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <p class="fs-15">
                        <strong class="font-weight-semi-bold text-black">Ghi chú:</strong> Chọn đáp án đúng nhất.
                    </p>
                </div>
            @endforeach

            <div class="text-right">
                <button type="submit" class="btn theme-btn">Nộp bài</button>
            </div>
        </form>
    </div><!-- end container -->

</section>
