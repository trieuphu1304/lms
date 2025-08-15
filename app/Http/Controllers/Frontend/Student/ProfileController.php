<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $template = 'frontend.profile.index';
        $user = Auth::user(); 
        //Lấy số lượng khóa học đã xem
        $enrollmentsCount = $user->enrollments()->count();

        // Lấy số lượng đánh giá của người dùng
        $reviewsCount = $user->reviews()->count();

        // Lấy số lượng chứng chỉ đã nhận
        $certificatesCount = $user->certificates()->count();

        //Lấy thông tin khóa học
        $joinedCourses = $user->coursesJoined()->with('teacher', 'reviews')->get();
        $wishlistCourses = [];
        if (auth()->check()) {
            $wishlistCourses = auth()->user()->favoriteCourses()->with('teacher')->paginate(6);
        }
        $wishlistIds = auth()->check() ? auth()->user()->favoriteCourses()->pluck('courses.id')->toArray() : [];

        return view('frontend.master', compact('template','user', 'enrollmentsCount', 'reviewsCount',  'certificatesCount', 'joinedCourses', 'wishlistCourses', 'wishlistIds'));
    }

    public function edit()
    {   $template = 'frontend.profile.edit';
        $user = Auth::user();
        return view('frontend.master', compact('user', 'template'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('student.profile')->with('success', 'Cập nhật thông tin thành công!');
    }


    public function showChangePassword()
    {   
        $template = 'frontend.profile.change_password';
        return view('frontend.master', compact('template'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('student.change_password')->with('success', 'Đổi mật khẩu thành công!');
    }
}