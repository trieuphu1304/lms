<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        // load student + course đúng theo model
        $reviews = Review::with(['student', 'course'])
            ->latest()
            ->paginate(20);

        $template = 'backend.admin.review.index';
        return view('backend.admin.master', compact('template', 'reviews'));
    }

    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()
            ->route('admin.review')
            ->with('success', 'Đã xóa đánh giá!');
    }
}