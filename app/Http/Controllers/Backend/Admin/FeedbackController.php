<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // Hiển thị danh sách feedback
    public function index()
    {
        $feedbacks = Feedback::with(['user', 'course'])->latest()->paginate(20);
        $template = 'backend.admin.feedback.index';
        return view('backend.master', compact('template', 'feedbacks'));
    }

    // Xóa feedback
    public function delete($id)
    {
        $feedbacks = Feedback::findOrFail($id);
        $feedbacks->delete();
        return redirect()->route('admin.feedback')->with('success', 'Đã xóa phản hồi!');
    }
}