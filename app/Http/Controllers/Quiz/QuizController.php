<?php

namespace App\Http\Controllers\quiz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\question;
use App\Models\answer;
use App\Models\quiz;
use App\Models\result;
use App\Models\soccer;
use DB;

class QuizController extends Controller
{
    private $question;
    private $quiz;
    private $answer;
    private $request;
    private $result;
    private $soccer;

    public function __construct(Question $question,Quiz $quiz,  Request $request, Answer $answer, Result $result,Soccer $soccer)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->quiz = $quiz;
        $this->request = $request;
        $this->result = $result;
        $this->soccer = $soccer;
    }
    public function index()
    {

        ///////////monta a lista de quiz cadastrados no banco////////
        $value = $this->quiz
            ->select(DB::raw('count(q.id) as qtd'),'name','quiz.id','description','quiz.created_at','quiz.updated_at')
            ->leftjoin ('public.question as q', 'q.quiz_id', '=', 'quiz.id')
            ->groupBy('quiz.id','name','description','quiz.created_at','quiz.updated_at')
            ->get();

         /////retorna na view///////
        return view('home_adm')->with(['value' => $value]);
    }
    public function insert()
    {
        /////////recebe valores do form/////////
        $quiz = $this->quiz;
        $quiz->name = $this->request->get('quiz_name');
        $quiz->description = $this->request->get('quiz_desc');

        //////////insere no banco////////////
        $save =  $this->quiz->save([$quiz]);


        /////////////retorna alerta na view////////
        if($save) {
            $this->request->session()->flash('alert-success', 'Dados Salvos com Sucesso!');
            return redirect('home');
        }
        else{
            $this->request->session()->flash('alert-danger', 'Ocorreu um ERRO ao salvar, tente novemente ou contate o administrador');
            return redirect('home');
        }

    }
    public function delete($id)
    {
        /////////delete quiz/////////
        $quiz = $this->quiz
            ->where('id', '=' , "$id")->delete();

        $question = $this->question
            ->where('quiz_id', '=' , "$id")->delete();
        $answer = $this->answer
            ->where('quiz_id', '=' , "$id")->delete();
        ////////

        /////////////retorna alerta na view////////
        if($quiz ) {
            $this->request->session()->flash('alert-success', 'Dados Excluídos com Sucesso!');
            return redirect('home');
        }
        else{
            $this->request->session()->flash('alert-danger', 'Ocorreu um ERRO ao salvar, tente novemente ou contate o administrador');
            return redirect('home');
        }


    }
    public function edit($id)
    {
        /////////monta as informações do quiz////////
        $quiz = $this->quiz
            ->select('*')
            ->where('id', '=', "$id")
            ->first();

        ///////retorna valores na view/////////
        return view('cadastro.quiz', compact('id', 'quiz'));
    }

    public function direct_result(Request $request)
    {
        ///recebe valor via ajax////
        $id = $request->get('id');

        /////////monta query//////////
        $value = $this->answer
            ->select ('s.name as name','qz.name as quiz','q.id as question_id','q.question','answer.answer',DB::raw('to_char(s.dt_ini, \'DD/MM/YYYY HH:MM:SS\') as dt_ini, to_char(result.dt_fim, \'DD/MM/YYYY HH:MM:SS\') as dt_fim') ,'is_correct')
            ->join ('result as result',  'result.answer_id', '=' ,'answer.id')
            ->join ('quiz as qz',  'qz.id', '=', 'result.quiz_id')
            ->join ('question as q', 'q.id', '=', 'result.question_id')
            ->join ('jogador as s','s.id' ,'=', 'result.jogador_id')
            ->where('s.id', '=', "$id")
            ->get();

        //////retorna solicitação ajax com resultado///////
        return response()->json($value);
    }

    public function result($id)
    {

        //////// pega todas as questões que tem no quiz////////
        $qtd_question = $this->question
            ->select('id','question')
            ->where('quiz_id', '=', "$id")

            ->get();

        //////// pega todas as alternativas "true" e "false" que tem no quiz////////
        $qtd_answer = $this->answer
            ->select('question_id','answer','is_correct')
            ->where('quiz_id', '=', "$id")
            ->get();

        //////// pega todas as alternativas "true" e "false" que tem no quiz////////
        $qtd_soccer = $this->soccer
            ->select('jogador.id','name','email')
            ->distinct('jogador.id','name','email','qtd')
            ->join('public.result as r', 'r.jogador_id','=', 'jogador.id')
            ->where('r.quiz_id','=',"$id")
            ->get();



        //var_dump($value);

        ////////retorna os valores na view ///////////
        return view('result_adm', compact('value','qtd_question','qtd_answer', 'qtd_soccer'));
    }


}
