<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $quiz = Quiz::has('questions')->orderBy('created_at', 'ASC')->get();

        return view('Site.Quiz.index', compact('quiz'));
    }
}
