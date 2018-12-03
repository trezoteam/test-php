<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionAnswer;
use App\Quiz;
use Illuminate\Http\Request;
use DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('subject','ASC')->get();

        return view('System.Question.list', compact('questions'));
    }

    public function create()
    {
        $quiz = Quiz::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('System.Question.create_and_edit', compact('quiz'));
    }

    public function edit($question_id) {
        $question = Question::find($question_id);

        $quiz = Quiz::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('System.Question.create_and_edit', compact('question', 'quiz'));
    }

    public function update(Request $request, $question_id) {
        try {
            DB::beginTransaction();

            $question = Question::find($question_id);

            $question->update($request->all());

            QuestionAnswer::where('question_id', $question_id)->delete();

            if ($request->answers) {
                foreach ($request->answers as $value) {
                    $question->answer()->create([
                        'answer' => $value['answer'],
                        'is_correct' => $value['is_correct'] == "true" ? 1 : 0
                    ]);
                }
            }
        }catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
        }

        DB::commit();


        return redirect()->route('question.index')->with('notice', 'Pergunta Atualizada com Sucesso!');
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $question = Question::create($request->all());

            if($request->answers) {
                foreach ($request->answers as $value) {
                    $question->answer()->create([
                        'answer' => $value['answer'],
                        'is_correct' => $value['is_correct'] == "true" ? 1 : 0
                    ]);
                }
            }
        }catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
        }

        DB::commit();

        return redirect()->route('question.index')->with('notice', 'Pergunta Cadastrada com sucesso!');
    }

    public function destroyAnswerAjax(Request $request) {
        try {
            DB::beginTransaction();
            QuestionAnswer::find($request->answer_id)->delete();

        }catch (\Illuminate\Database\QueryException $e) {
            DB::roolback();
        }

        DB::commit();


    }

    public function destroy(Request $request, $question_id) {
        try {
            DB::beginTransaction();

            QuestionAnswer::where('question_id', $question_id)->delete();
            Question::find($question_id)->delete();
        }catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
        }

        DB::commit();

        return redirect()->route('question.index')->with('notice', 'Pergunta Excluída!');
    }
}
