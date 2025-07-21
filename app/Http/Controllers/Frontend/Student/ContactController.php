<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        
        $template = 'frontend.contact.index';
        return view('frontend.master', compact('template'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'subject', 'message'));

        // Kiểm tra nếu là Ajax request
        if ($request->ajax()) {
            return response()->json(['message' => 'Gửi liên hệ thành công']);
        }

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ!');
    }


}