<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;  
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $template = 'backend.teacher.section.index';
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
        return view('backend.teacher.master', compact('template','sections'));
    }

    public function create()
    {
        $teacherId = Auth::id(); 
        $courses = Course::where('teacher_id', $teacherId)->get();

        $template = 'backend.teacher.section.create';
        return view('backend.teacher.master', compact('courses', 'template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        Section::create($request->all());
        return redirect()->route('teacher.section')->with('success', 'Section created successfully.');
    }

    public function edit($id)
    {
        $template = 'backend.teacher.section.edit';
        $section = Section::findOrFail($id);
        $teacherId = Auth::id(); 
        $courses = Course::where('teacher_id', $teacherId)->get();

        return view('backend.teacher.master', compact('section', 'courses', 'template'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $section = Section::findOrFail($id);
        $section->update($request->all());
        return redirect()->route('teacher.section')->with('success', 'Section updated successfully.');
    }

    public function delete($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('teacher.section')->with('success', 'Section deleted successfully.');
    }
}