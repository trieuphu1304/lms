<div class="page-content">
    <div class="container">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-warning text-white d-flex align-items-center">
                <i class="bx bx-edit fs-4 me-2"></i>
                <h4 class="mb-0">Chỉnh sửa danh mục</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-label"></i> Tên danh mục</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bx bx-detail"></i> Mô tả</label>
                        <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.categories') }}" class="btn btn-secondary me-2">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bx bx-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
