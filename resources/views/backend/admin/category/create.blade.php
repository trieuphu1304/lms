<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="bx bx-category fs-4 me-2"></i>
                <h4 class="mb-0">Thêm danh mục mới</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-label"></i> Tên danh mục</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-detail"></i> Mô tả</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Nhập mô tả"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.categories') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i> Lưu danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
