<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    public function answerSession(Request $r) {
        session(['hour_start' => date('H:i:s'),
            'name'       => $r->name,
            'email'      => $r->email
        ]);

        return redirect()->route('quiz.answer', $r->quiz_id);
    }

    public function answer($quiz_id) {
        $quiz= Quiz::find($quiz_id);

        return view('Site.Quiz.answer', compact('quiz'));
    }

    public function store(Request $request) {

        $hour_start = session('hour_start');
        $hour_end = date('H:i:s');
        $user = session('name');
        $email = session('email');
        $answers = $request->questions;
        $quiz = Quiz::find($request->quiz_id);

        //dd($answers);

        $hits = 0;
        $errors = 0;
        $answers_count = 0;

        foreach($request->questions as $key => $value) {
            $answers_count++;
            $q = Question::find($key);

            $answerCorrect = $q->answerCorrect->first();

            if($q->type == 1) {
                if (strcmp($answerCorrect->answer, $value) !== 0) {
                    $errors++;
                }
                else {
                    $hits++;
                }
            } else {
                $hits++;
            }
        }

        return view('Site.Quiz.result',
            compact('hour_start',
                'hour_end',
                'user',
                'email',
                'answers',
                'quiz',
                'answers_count',
                'errors',
                'hits'));
    }
}
