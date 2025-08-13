<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;


class TeacherChatController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $courses = Course::where('teacher_id', $teacher->id)->get();
        
        $template = 'backend.teacher.chat.index';
        return view('backend.teacher.master', compact('template', 'courses', 'teacher'));
    }

    public function getStudents(Course $course)
    {
        $students = $course->students; // quan hệ students() trong model Course
        $teacher = Auth::user();
        return view('backend.teacher.chat.partials.student_list', compact('students', 'course', 'teacher'));
    }

    public function getMessages($courseId, $studentId)
{
    $course = Course::findOrFail($courseId);
    $student = User::findOrFail($studentId);

    $messages = Message::where('course_id', $courseId)
        ->where(function ($q) use ($studentId) {
            $q->where('sender_id', auth()->id())->where('receiver_id', $studentId)
              ->orWhere(function ($q2) use ($studentId) {
                  $q2->where('sender_id', $studentId)->where('receiver_id', auth()->id());
              });
        })
        ->with('sender') // load avatar, name
        ->orderBy('created_at', 'asc')
        ->get();

    return view('backend.teacher.chat.partials.chatbox_student', [
        'messages' => $messages,
        'student'  => $student,
        'courseId' => $courseId,
        'studentId'=> $studentId
    ]);
}


    public function sendMessage(Request $request)
{
    $request->validate([
        'course_id'   => 'required|exists:courses,id',
        'receiver_id' => 'required|exists:users,id',
        'message'     => 'required|string|max:1000'
    ]);

    Message::create([
        'course_id'   => $request->course_id,
        'sender_id'   => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message'     => $request->message
    ]);

    return response()->json(['status' => 'success']);
}


}