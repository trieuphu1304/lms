<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $template = 'backend.admin.category.index';
        $categories = Category::latest()->get();
        return view('backend.admin.master', compact('template', 'categories'));
    }

    public function create()
    {
        $template = 'backend.admin.category.create';
        return view('backend.admin.master', compact('template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create($request->only('name', 'description'));
        return redirect()->route('admin.categories')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit(Category $category)
    {
        $template = 'backend.admin.category.edit';
        return view('backend.admin.master', compact('template', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($request->only('name', 'description'));
        return redirect()->route('admin.categories')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Xóa danh mục thành công!');
    }
}