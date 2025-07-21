<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        
        $template = 'frontend.about.index';
        return view('frontend.master', compact('template'));
    }

}