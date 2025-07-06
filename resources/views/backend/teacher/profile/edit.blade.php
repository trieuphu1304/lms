<div class="content container-fluid">
    <div class="container">
        <h2 class="mb-4">Chỉnh sửa thông tin cá nhân</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Nếu bạn dùng PUT method --}}
            @method('POST')

            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mt-2 rounded-circle"
                        width="100">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=100" alt="Avatar"
                        class="mt-2 rounded-circle">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
        </form>
    </div>
</div>
