<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {   
        $user = Auth::user();
        $template = 'backend.teacher.dashboard.index';
        return view('backend.teacher.master', compact('template', 'user'));
    }
}