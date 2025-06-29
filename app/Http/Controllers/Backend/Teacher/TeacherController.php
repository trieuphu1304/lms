<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {   
        $template = 'backend.teacher.dashboard.index';
        return view('backend.teacher.master', compact('template'));
    }

    // Bạn có thể thêm các phương thức khác cho giáo viên ở đây
}