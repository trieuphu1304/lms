<section class="breadcrumb-area">
    <div class="bg-white py-3 pattern-bg">
        <div class="container">
            <div class="breadcrumb-content">
                <ul class="quiz-nav d-flex flex-wrap align-items-center">
                    <li>
                        <a href="{{ route('lessons.show', $lesson->id) }}"><i class="la la-arrow-left mr-2"></i>Quay lại
                            bài giảng
                        </a>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('course.detail', $course->id) }}">
                                <img src="{{ $lesson->course->avatar ? asset('storage/' . $lesson->course->avatar) : asset('frontend/images/default-course.jpg') }}"
                                    alt="{{ $course->title }}">
                            </a>
                            <p>
                                <a href="{{ route('course.detail', $course->id) }}">{{ $course->title }}</a>
                                <span class="d-block fs-13">{{ $teacher->name ?? 'Giáo viên' }}</span>
                            </p>

                        </div>
                    </li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </div>
    <div class="bg-dark pt-60px pb-60px">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <div class="section-heading">
                    <p class="section__desc text-white-50">
                        Nộp vào {{ \Carbon\Carbon::parse($result['submitted_at'])->format('d M Y') }}
                    </p>

                    <h2 class="section__title text-white pt-2">
                        Điểm của bạn {{ $result['score'] }}/{{ $result['total'] }} ({{ $result['percentage'] }}%)
                    </h2>
                </div>

                <div class="breadcrumb-btn-box pt-30px">
                    <a href="{{ route('quiz.show', $lesson->id) }}"
                        class="btn theme-btn theme-btn-transparent text-white-50 mr-2 mb-2">
                        Làm lại
                    </a>

                    <a href="{{ route('lessons.show', $lesson->id) }}"
                        class="btn theme-btn theme-btn-transparent text-white-50 mb-2">
                        Xem lại bài học
                    </a>
                </div>
            </div>
        </div><!-- end container -->

    </div>
    <div class="quiz-action-nav bg-white py-3 shadow-sm">
        <div class="container">
            <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
                <ul class="quiz-nav d-flex flex-wrap align-items-center">
                    <li>
                        <i class="la la-check-circle fs-17 mr-2"></i>
                        {{ $result['score'] }}/{{ $result['total'] }} Điểm
                    </li>
                    <li>
                        <i class="la la-clock fs-17 mr-2"></i>
                        {{ $result['duration'] ?? 'N/A' }}
                    </li>
                    <li>
                        <i class="la la-bar-chart fs-17 mr-2"></i>
                        @if ($result['percentage'] >= 80)
                            Nâng cao
                        @elseif ($result['percentage'] >= 50)
                            Trung bình
                        @else
                            Cơ bản
                        @endif
                    </li>
                </ul>
            </div>
        </div><!-- end container -->

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
        <div class="quiz-ans-content">
            @foreach ($result['answers'] as $index => $answer)
                <div class="quiz-ans-content mb-5">
                    <div class="d-flex align-items-center">

                        <h3 class="fs-22 font-weight-semi-bold">Câu hỏi {{ $index + 1 }}
                        </h3>
                    </div>
                    <p class="pt-2">{{ $answer['question'] }}</p>

                    <ul class="quiz-result-list pt-4 pl-3">
                        @foreach (['a', 'b', 'c', 'd'] as $opt)
                            @php
                                $question = $quiz->questions->where('question_text', $answer['question'])->first();
                                $optText = $question?->{'option_' . $opt};
                                $isSelected = strtolower($opt) === strtolower($answer['answer'] ?? '');
                                $isCorrect = strtolower($opt) === strtolower($answer['correct'] ?? '');

                            @endphp

                            @if ($optText)
                                <li class="text-black mb-2">
                                    @if ($isSelected && $isCorrect)
                                        <span
                                            class="icon-element icon-element-xs bg-success text-white mr-2 border border-gray">
                                            <i class="la la-check"></i>
                                        </span>
                                    @elseif ($isSelected && !$isCorrect)
                                        <span
                                            class="icon-element icon-element-xs bg-danger text-white mr-2 border border-gray">
                                            <i class="la la-times"></i>
                                        </span>
                                    @elseif ($isCorrect)
                                        <span
                                            class="icon-element icon-element-xs bg-success text-white mr-2 border border-gray">
                                            <i class="la la-check"></i>
                                        </span>
                                    @else
                                        <span class="icon-element icon-element-xs mr-2 border border-gray">
                                            {{ strtoupper($opt) }}
                                        </span>
                                    @endif
                                    {{ $optText }}
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            @endforeach

        </div>
    </div><!-- end container -->
</section>
