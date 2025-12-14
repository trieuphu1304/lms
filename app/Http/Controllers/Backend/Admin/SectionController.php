<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Course;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Section::with('course'); // eager load quan hệ

        if ($request->filled('section')) {
            $query->where('title', 'like', '%' . $request->section . '%');
        }

        if ($request->filled('course')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->course . '%');
            });
        }

        $sections = $query->orderBy('id', 'desc')->paginate(10);

       

        $template = 'backend.admin.section.index';
        return view('backend.admin.master', compact('template', 'sections'));
    }

    public function create()
    {
        // Lấy danh sách khóa học để hiển thị trong dropdown (nếu cần)
        $courses = Course::all(); 
        $template = 'backend.admin.section.create';
        return view('backend.admin.master', compact('template', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id', 
        ]);


        $section = new Section;
        $section->title = $request->input('title');
        $section->course_id = $request->input('course_id'); // Lưu ID khóa học
        $section->save();

        return redirect()->route('admin.section')->with('success', 'Chương đã được thêm thành công!');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        // Lấy danh sách khóa học để hiển thị trong dropdown (nếu cần)
        $courses = Course::all();
        $template = 'backend.admin.section.edit';
        return view('backend.admin.master', compact('template', 'section', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id', 
        ]);

        $section = Section::findOrFail($id);
        $section->title = $request->input('title');
        $section->course_id = $request->input('course_id'); // Cập nhật ID khóa học
        $section->save();

        return redirect()->route('admin.section')->with('success', 'Chương đã được cập nhật thành công!');
    }

    public function delete($id)
    {
        Section::destroy($id);
        return redirect()->route('admin.section')->with('success', 'Chương đã được xóa thành công!');
    }

    public function search(Request $request)
    {
        $query = Section::with('course');

        if ($request->filled('section')) {
            $query->where('title', 'like', '%' . $request->section . '%');
        }

        if ($request->filled('course')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->course . '%');
            });
        }

        $sections = $query->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'sections' => $sections->items(),
            'total' => $sections->total(),
            'current_page' => $sections->current_page(),
            'last_page' => $sections->last_page(),
        ]);
    }
}