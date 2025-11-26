<form id="filterForm" method="GET" action="{{ route('student.courses') }}" class="d-flex align-items-center w-100 gap-3">

    {{-- Sắp xếp --}}
    <div class="my-course-filter-item">
        <span class="fs-14 font-weight-semi-bold">Sắp xếp</span>
        <div class="select-container">
            <select name="sort" class="select-container-select">
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Gần đây</option>
                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A-Z</option>
                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z-A</option>
                </option>
            </select>
        </div>
    </div>

    {{-- Danh mục --}}
    <div class="my-course-filter-item">
        <span class="fs-14 font-weight-semi-bold">Danh mục</span>
        <div class="select-container">
            <select name="category_id" class="select-container-select">
                <option value="">Tất cả</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Tiến độ --}}
    <div class="my-course-filter-item">
        <span class="fs-14 font-weight-semi-bold">Tiến độ</span>
        <div class="select-container">
            <select name="progress" class="select-container-select">
                <option value="">Tất cả</option>
                <option value="not_started" {{ request('progress') == 'not_started' ? 'selected' : '' }}>Chưa học
                </option>
                <option value="in_progress" {{ request('progress') == 'in_progress' ? 'selected' : '' }}>Đang học
                </option>
                <option value="completed" {{ request('progress') == 'completed' ? 'selected' : '' }}>Hoàn thành
                </option>
            </select>
        </div>
    </div>

    {{-- Tìm kiếm --}}
    <div class="my-course-filter-item">
        <span class="fs-14 font-weight-semi-bold">Tìm kiếm</span>
        <div class="input-group">
            <input type="text" name="search" class="form-control form--control form--control-gray"
                placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn theme-btn shadow-none"><i class="la la-search"></i></button>
            </div>
        </div>
    </div>

    {{-- Nút --}}
    <div class="my-course-filter-item d-flex align-items-end">
        <button type="submit" class="btn btn-primary mr-2"
            style="display: flex;align-items: center; justify-content: center; width: 75px;height: 50px;margin-top: 25px;"">Lọc</button>
        <a href="{{ route('student.courses') }}" class="btn btn-secondary"
            style="display: flex;align-items: center;width: 75px;height: 50px;margin-top: 25px;">
            Đặt lại</a>
    </div>
</form>
