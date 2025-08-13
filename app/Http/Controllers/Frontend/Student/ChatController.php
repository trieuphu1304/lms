<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Events\ChatMessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class ChatController extends Controller
{
    public function index()
    {
        $template = 'frontend.chat.chat-list'; // view con bên trong layout master
        $student = Auth::user()->load('coursesJoined');
        $enrolledCourses = $student->coursesJoined;

        return view('frontend.master', compact('template', 'enrolledCourses'));
    }
    public function loadMessages($courseId)
    {
        $student = Auth::user();
        $student->load('coursesJoined');

        if (!$student->coursesJoined->contains('id', $courseId)) {
            return response()->json([
                'html' => '<div class="text-center text-danger mt-5">Bạn chưa đăng ký khóa học này.</div>'
            ]);
        }

        $course = Course::with('teacher')->findOrFail($courseId);
        $teacher = $course->teacher;

        $messages = Message::where(function ($q) use ($student, $teacher, $courseId) {
            $q->where('course_id', $courseId)
            ->where('sender_id', $student->id)
            ->where('receiver_id', $teacher->id);
        })
        ->orWhere(function ($q) use ($student, $teacher, $courseId) {
            $q->where('course_id', $courseId)
            ->where('sender_id', $teacher->id)
            ->where('receiver_id', $student->id);
        })
        ->orderBy('created_at')
        ->get();


        $html = view('frontend.chat.chat-box', [
            'messages' => $messages,
            'teacher' => $teacher,
            'courseId' => $courseId
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function showChat($courseId)
    {
        $student = Auth::user();
        $student->load('coursesJoined');
        $course = Course::with('teacher')->findOrFail($courseId);
        $teacher = $course->teacher;

        if (!$student->coursesJoined->contains($course->id)) {
            abort(403, 'Bạn chưa đăng ký khóa học này.');
        }

        $messages = Message::where(function ($q) use ($student, $teacher, $courseId) {
            $q->where('course_id', $courseId)
            ->where('sender_id', $student->id)
            ->where('receiver_id', $teacher->id);
        })
        ->orWhere(function ($q) use ($student, $teacher, $courseId) {
            $q->where('course_id', $courseId)
            ->where('sender_id', $teacher->id)
            ->where('receiver_id', $student->id);
        })
        ->orderBy('created_at')
        ->get();


        $enrolledCourses = $student->coursesJoined;
        $template = 'frontend.chat.chat-list';
        $currentCourseId = $courseId;
        return view('frontend.master', compact(
            'messages', 'teacher', 'currentCourseId', 'enrolledCourses', 'template'
        ));

    }

    public function sendMessage(Request $request, $courseId)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message'     => 'required|string|max:1000',
    ]);

    // Nếu form không gửi course_id, thêm vào từ URL
    if (!$request->filled('course_id')) {
        $request->merge(['course_id' => $courseId]);
    }

    $message = Message::create([
        'sender_id'   => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'course_id'   => $request->course_id,
        'message'     => $request->message,
    ]);

    broadcast(new ChatMessageSent(Auth::user(), $message->message))->toOthers();

    return response()->json(['status' => 'Message Sent!']);
}




}