<div class="content container-fluid">
    <div class="page-header mb-4">
        <h3 class="page-title text-primary fw-semibold">Thêm Danh Mục Mới</h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-warning border-start border-warning border-3 rounded">
            <strong>Lỗi!</strong> Vui lòng kiểm tra lại thông tin.
            <ul class="mt-2 mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.categories.store') }}" method="POST">
        @csrf
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-light-purple text-dark fw-semibold border-bottom">
                <i class="bx bx-layer me-1"></i> Thông tin danh mục
            </div>

            <div class="card-body bg-white">
                <div class="mb-3">
                    <label class="form-label text-muted">Tên danh mục</label>
                    <input type="text" name="name" class="form-control rounded-3"
                        placeholder="VD: Lập trình, Thiết kế đồ họa..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Mô tả (Không bắt buộc)</label>
                    <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Ghi chú thêm về danh mục..."></textarea>
                </div>
            </div>

            <div class="card-footer bg-light-purple text-end rounded-bottom-4">
                <a href="{{ route('teacher.categories.index') }}" class="btn btn-outline-secondary me-2 rounded-3">
                    <i class="bx bx-arrow-back"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bx bx-save"></i> Lưu danh mục
                </button>
            </div>
        </div>
    </form>
</div>
