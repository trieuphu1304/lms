<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    { 
        $template='backend.teacher.category.index';
        $categories = Category::latest()->get();
        return view('backend.teacher.master', compact('template','categories'));
    }

    public function create()
    {
        $template='backend.teacher.category.create';
        return view('backend.teacher.master', compact('template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->only('name', 'description'));
        return redirect()->route('teacher.categories.index')->with('success', 'Tạo danh mục thành công');
    }

    public function edit(Category $category)
    {
        $template='backend.teacher.category.edit';
        return view('backend.teacher.master', compact('template','category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name', 'description'));
        return redirect()->route('teacher.categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }
}