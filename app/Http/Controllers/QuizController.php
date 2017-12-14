<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Quiz;
use DB;
use Illuminate\Http\Request;


class QuizController extends Controller
{

    public function index() {
        $quiz = Quiz::orderBy('name', 'asc')->get();

        return view('System.Quiz.list', compact('quiz'));
    }

    public function create() {
        return view('System.Quiz.create_and_edit');
    }

    public function edit($quiz_id) {
       $quiz = Quiz::find($quiz_id);

        return view('System.Quiz.create_and_edit', compact('quiz'));
    }

    public function store(QuizRequest $request)
    {
        try {
            DB::beginTransaction();

            Quiz::create($request->all());

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return redirect()->route('quiz.index')->with('error', 'Não foi possível efetuar o cadastro');
        }

        DB::commit();

        return redirect()->route('quiz.index')->with('notice', 'Cadastro feito com sucesso!');
    }

    public function update(QuizRequest $request, $quiz_id) {
        try{
            DB::beginTransaction();
            Quiz::find($quiz_id)->update($request->all());
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return redirect()->route('quiz.indez')->with('error', 'Não foi possível atualizar!');
        }

        DB::commit();

        return redirect()->route('quiz.index')->with('notice', 'Quiz Atualizado com sucesso!');
    }

    public function destroy($quiz_id) {
        try {
            DB::beginTransaction();
            Quiz::find($quiz_id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return redirect()->route('quiz.index')->with('error', 'Não foi possível excluir!');
        }

        DB::commit();

        return redirect()->route('quiz.index')->with('notice', 'Quiz Excluído com sucesso!');
    }
}
