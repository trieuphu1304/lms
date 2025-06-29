<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::all();

        $template = 'backend.admin.account.index';
        return view('backend.admin.master', compact('template', 'users'));
    }

    public function create() {

        $template = 'backend.admin.account.create';
        return view('backend.admin.master', compact(
            'template'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'role' => 'required', 
        ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); 
        $user->role = $request->input('role');
        $user->save();
       
        return redirect()->route('admin.account')->with('success', 'Tài khoản đã được thêm thành công!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $template = 'backend.admin.account.edit';
        return view('backend.admin.master', compact(
            'template',
            'user'
        ));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|string',
            'role' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        return redirect()->route('admin.account')->with('success', 'Tài khoản đã được cập nhật thành công!');
    }

    public function delete($id) {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.account')->with('success', 'Tài khoản đã được xóa!');
        }
        return redirect()->route('admin.account')->with('error', 'Không tìm thấy tài khoản!');
    }

}