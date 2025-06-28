<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Hiển thị trang thông tin cá nhân
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $template = 'backend.admin.profile.index';
        return view('backend.master', compact('template', 'user'));
    }

    // Hiển thị form chỉnh sửa thông tin cá nhân
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $template = 'backend.admin.profile.edit';
        return view('backend.master', compact('template', 'user'));
    }

    // Cập nhật thông tin cá nhân
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Xử lý upload avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $filename, 'public');
            $user->avatar = $path;
        }

        $user->save();
        return redirect()->route('admin.profile')->with('success', 'Cập nhật thông tin thành công!');
    }

    // Hiển thị form đổi mật khẩu
    public function changePassword()
    {
        $user = Auth::user();
        $template = 'backend.admin.profile.change_password';
        return view('backend.master', compact('template', 'user'));
    }

    // Xử lý đổi mật khẩu
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng!']);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('admin.profile')->with('success', 'Đổi mật khẩu thành công!');
    }
}